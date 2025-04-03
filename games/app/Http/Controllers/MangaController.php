<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Manga;
use App\Models\Editorial;
use App\Models\Autor;
use App\Models\Genero;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class MangaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
        $this->middleware(AdminMiddleware::class)->only(['create', 'store', 'edit', 'update', 'destroy']);
    }
    public function index()
    {
        // Primero obtenemos todas las categorías (géneros)
        $categorias = \App\Models\Genero::all();
        
        // Para cada categoría, obtenemos sus mangas
        $mangasPorCategoria = $categorias->map(function($categoria) {
            return [
                'categoria' => $categoria->nombre,
                'mangas' => Manga::whereHas('generos', function($query) use ($categoria) {
                    $query->where('generos.id', $categoria->id);
                })
                ->select([
                    'id',
                    'titulo',
                    'imagen_portada',
                    'rating',
                    'descripcion'
                ])
                ->addSelect(DB::raw("'Manga' as type"))
                ->addSelect(DB::raw("(SELECT GROUP_CONCAT(nombre SEPARATOR ', ') FROM generos WHERE id IN (SELECT genero_id FROM manga_genero WHERE manga_id = mangas.id)) as category"))
                ->take(10)
                ->get()
                ->map(function($manga) {
                    $manga->titulo = $manga->titulo;
                    $manga->imagen_portada = $manga->imagen_portada ?: 'https://placehold.co/160x200/1F2937/FFFFFF/png?text=No+Image';
                    return $manga;
                })
            ];
        })->filter(function($categoria) {
            return $categoria['mangas']->isNotEmpty();
        });

        return view('mangas.index', compact('mangasPorCategoria'));
    }
    
    public function show(Manga $manga)
    {
        $estadisticas = [
            'leidos' => $manga->usuariosLeido()->count(),
            'leyendo' => $manga->usuariosLeyendo()->count(),
            'pendientes' => $manga->usuariosPendiente()->count(),
            'abandonados' => $manga->usuariosAbandonado()->count()
        ];

        $estadoActual = null;
        if (auth()->check()) {
            $estadoActual = $manga->usuariosConEstado()
                ->where('user_id', auth()->id())
                ->first()?->pivot->state;
        }

        return view('mangas.show', compact('manga', 'estadisticas', 'estadoActual'));
    }
    
    public function create()
    {
        $editoriales = Editorial::all();
        $autores = Autor::all();
        $generos = Genero::all();
        
        return view('mangas.create', compact('editoriales', 'autores', 'generos'));
    }
    
    public function store(Request $request) {
        $validated = $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'fecha_publicacion' => 'required|date',
            'editorial_id' => 'required|exists:editorials,id',
            'autores' => 'required|array|min:1',
            'autores.*' => 'exists:autors,id',
            'generos' => 'required|array|min:1',
            'generos.*' => 'exists:generos,id',
            'imagen_portada' => 'nullable|string',
            'rating' => 'nullable|numeric|min:0|max:10'
        ]);
        
        \Log::info('Datos validados:', $validated);
        
        try {
            DB::beginTransaction();
            
            $manga = Manga::create([
                'titulo' => $validated['titulo'],
                'descripcion' => $validated['descripcion'],
                'fecha_publicacion' => $validated['fecha_publicacion'],
                'editorial_id' => $validated['editorial_id'],
                'imagen_portada' => $validated['imagen_portada'] ?? null,
                'rating' => $validated['rating'] ?? 0
            ]);
            
            \Log::info('Manga creado:', ['id' => $manga->id]);

            // Guardar relaciones
            if (isset($validated['autores'])) {
                $manga->autores()->attach($validated['autores']);
                \Log::info('Autores asociados:', $validated['autores']);
            }

            if (isset($validated['generos'])) {
                $manga->generos()->attach($validated['generos']);
                \Log::info('Géneros asociados:', $validated['generos']);
            }

            DB::commit();
            return redirect()->route('mangas.index')->with('success', 'Manga creado correctamente');
            
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Error al crear manga:', ['error' => $e->getMessage()]);
            return back()->withInput()->withErrors(['error' => 'Error al crear el manga: ' . $e->getMessage()]);
        }
    }
    
    public function edit(Manga $manga) {
        $editorials = Editorial::all();
        $autores = Autor::all();
        $generos = Genero::all();
        return view('mangas.edit', compact('manga', 'editorials', 'autores', 'generos'));
    }
    
    public function update(Request $request, Manga $manga) {
        $validated = $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'fecha_publicacion' => 'required|date',
            'editorial_id' => 'required|exists:editorials,id',
            'autores' => 'required|array|min:1',
            'autores.*' => 'exists:autors,id',
            'generos' => 'required|array|min:1',
            'generos.*' => 'exists:generos,id',
        ]);
        
        $manga->update([
            'titulo' => $validated['titulo'],
            'descripcion' => $validated['descripcion'],
            'fecha_publicacion' => $validated['fecha_publicacion'],
            'editorial_id' => $validated['editorial_id'],
        ]);

        $manga->autores()->sync($validated['autores']);
        $manga->generos()->sync($validated['generos']);

        return redirect()->route('mangas.index')->with('success', 'Manga actualizado correctamente');
    }
    
    public function destroy(Manga $manga) {
        $manga->delete();
        return redirect()->route('mangas.index');
    }

    public function estados() {
        $mangas = Manga::with(['autores', 'editorial', 'generos'])
            ->with(['usuariosConEstado' => function($query) {
                $query->where('user_id', Auth::id());
            }])
            ->get();

        return view('mangas.estados', compact('mangas'));
    }

    public function cambiarEstado(Request $request, Manga $manga)
    {
        $request->validate([
            'estado' => 'required|in:leido,leyendo,pendiente,abandonado'
        ]);

        $estadoActual = $manga->usuariosConEstado()
            ->where('user_id', Auth::id())
            ->first();

        if ($estadoActual) {
            if ($estadoActual->pivot->state === $request->estado) {
                // Si el estado es el mismo, lo eliminamos
                $manga->usuariosConEstado()->detach(Auth::id());
            } else {
                // Si es diferente, actualizamos al nuevo estado
                $manga->usuariosConEstado()->updateExistingPivot(Auth::id(), ['state' => $request->estado]);
            }
        } else {
            // Si no existe, creamos la relación con el nuevo estado
            $manga->usuariosConEstado()->attach(Auth::id(), ['state' => $request->estado]);
        }

        return redirect()->back();
    }

    public function eliminarEstado(Manga $manga)
    {
        // Eliminar el estado del manga para el usuario actual
        $manga->usuariosConEstado()->detach(Auth::id());

        return redirect()->back()->with('success', 'Estado eliminado correctamente');
    }
}
