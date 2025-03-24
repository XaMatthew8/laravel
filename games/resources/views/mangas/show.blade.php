<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ $manga->titulo }}
            </h2>
            <div class="flex space-x-4">
                <a href="{{ route('mangas.edit', $manga) }}" class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">
                    {{ __('Editar Manga') }}
                </a>
                <a href="{{ route('mangas.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                    {{ __('Volver') }}
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Información Principal -->
                        <div class="space-y-6">
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-2">Información Principal</h3>
                                <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-4">
                                    <p class="mb-2"><span class="font-medium">Título:</span> {{ $manga->titulo }}</p>
                                    <p class="mb-2"><span class="font-medium">Descripción:</span> {{ $manga->descripcion }}</p>
                                    <p class="mb-2"><span class="font-medium">Fecha de Publicación:</span> {{ $manga->fecha_publicacion }}</p>
                                </div>
                            </div>

                            <!-- Autores -->
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-2">Autores</h3>
                                <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-4">
                                    @if($manga->autores->count() > 0)
                                        <ul class="list-disc list-inside">
                                            @foreach($manga->autores as $autor)
                                                <li>{{ $autor->nombre }}</li>
                                            @endforeach
                                        </ul>
                                    @else
                                        <p class="text-gray-500 dark:text-gray-400">Sin autores asignados</p>
                                    @endif
                                </div>
                            </div>

                            <!-- Géneros -->
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-2">Géneros</h3>
                                <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-4">
                                    @if($manga->generos->count() > 0)
                                        <div class="flex flex-wrap gap-2">
                                            @foreach($manga->generos as $genero)
                                                <span class="px-3 py-1 bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-200 rounded-full text-sm">
                                                    {{ $genero->nombre }}
                                                </span>
                                            @endforeach
                                        </div>
                                    @else
                                        <p class="text-gray-500 dark:text-gray-400">Sin géneros asignados</p>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Editorial y Reseñas -->
                        <div class="space-y-6">
                            <!-- Editorial -->
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-2">Editorial</h3>
                                <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-4">
                                    @if($manga->editorial)
                                        <p>{{ $manga->editorial->nombre }}</p>
                                    @else
                                        <p class="text-gray-500 dark:text-gray-400">Sin editorial asignada</p>
                                    @endif
                                </div>
                            </div>

                            <!-- Reseñas -->
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-2">Reseñas</h3>
                                <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-4">
                                    @if($manga->reseñas->count() > 0)
                                        <div class="space-y-4">
                                            @foreach($manga->reseñas as $reseña)
                                                <div class="border-b border-gray-200 dark:border-gray-600 pb-4 last:border-0">
                                                    <div class="flex justify-between items-start">
                                                        <div>
                                                            <p class="font-medium">{{ $reseña->usuario->name }}</p>
                                                            <p class="text-sm text-gray-500 dark:text-gray-400">{{ $reseña->created_at->format('d/m/Y') }}</p>
                                                        </div>
                                                        <div class="flex items-center">
                                                            @for($i = 1; $i <= 5; $i++)
                                                                <svg class="w-5 h-5 {{ $i <= $reseña->puntuacion ? 'text-yellow-400' : 'text-gray-300 dark:text-gray-600' }}" fill="currentColor" viewBox="0 0 20 20">
                                                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                                                </svg>
                                                            @endfor
                                                        </div>
                                                    </div>
                                                    <p class="mt-2 text-gray-600 dark:text-gray-300">{{ $reseña->comentario }}</p>
                                                </div>
                                            @endforeach
                                        </div>
                                    @else
                                        <p class="text-gray-500 dark:text-gray-400">No hay reseñas aún</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 