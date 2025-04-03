@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-[#1a1f2c]">
        <div class="py-6">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Header -->
                <div class="mb-8 text-center">
                    <h1 class="text-4xl font-bold text-white bg-clip-text text-transparent bg-gradient-to-r from-blue-400 to-indigo-400 inline-block">Mi Biblioteca Manga</h1>
                    <p class="mt-2 text-gray-400 text-lg">Bienvenido a tu colección personal de manga</p>
                </div>

                <!-- Stats Overview -->
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                    <div class="bg-[#242937] rounded-lg p-6 transform hover:scale-105 transition-all duration-300 shadow-lg hover:shadow-blue-500/20 border border-[#2e3444]">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-lg text-gray-300 font-medium">Mangas Leídos</p>
                                <h3 class="text-3xl font-bold text-blue-400 mt-2">{{ auth()->user()->mangasLeidos()->count() }}</h3>
                            </div>
                            <div class="bg-blue-500/10 p-3 rounded-lg backdrop-blur-sm">
                                <i class="fas fa-book-reader text-2xl text-blue-400"></i>
                            </div>
                        </div>
                    </div>

                    <div class="bg-[#242937] rounded-lg p-6 transform hover:scale-105 transition-all duration-300 shadow-lg hover:shadow-indigo-500/20 border border-[#2e3444]">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-lg text-gray-300 font-medium">Leyendo Actualmente</p>
                                <h3 class="text-3xl font-bold text-indigo-400 mt-2">{{ auth()->user()->mangasLeyendo()->count() }}</h3>
                            </div>
                            <div class="bg-indigo-500/10 p-3 rounded-lg backdrop-blur-sm">
                                <i class="fas fa-book-open text-2xl text-indigo-400"></i>
                            </div>
                        </div>
                    </div>

                    <div class="bg-[#242937] rounded-lg p-6 transform hover:scale-105 transition-all duration-300 shadow-lg hover:shadow-blue-500/20 border border-[#2e3444]">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-lg text-gray-300 font-medium">Lista de Pendientes</p>
                                <h3 class="text-3xl font-bold text-blue-400 mt-2">{{ auth()->user()->mangasPendientes()->count() }}</h3>
                            </div>
                            <div class="bg-blue-500/10 p-3 rounded-lg backdrop-blur-sm">
                                <i class="fas fa-clock text-2xl text-blue-400"></i>
                            </div>
                        </div>
                    </div>

                    <div class="bg-[#242937] rounded-lg p-6 transform hover:scale-105 transition-all duration-300 shadow-lg hover:shadow-indigo-500/20 border border-[#2e3444]">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-lg text-gray-300 font-medium">Total de Mangas</p>
                                <h3 class="text-3xl font-bold text-indigo-400 mt-2">
                                    {{ auth()->user()->mangasLeidos()->count() + auth()->user()->mangasLeyendo()->count() + auth()->user()->mangasPendientes()->count() }}
                                </h3>
                            </div>
                            <div class="bg-indigo-500/10 p-3 rounded-lg backdrop-blur-sm">
                                <i class="fas fa-books text-2xl text-indigo-400"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Main Content -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <!-- Leyendo Actualmente -->
                    <div class="lg:col-span-2">
                        <div class="bg-[#242937] backdrop-blur-md rounded-lg shadow-xl p-6 border border-[#2e3444]">
                            <div class="flex justify-between items-center mb-6">
                                <h2 class="text-2xl font-semibold text-white bg-clip-text text-transparent bg-gradient-to-r from-blue-400 to-indigo-400 inline-block">Leyendo Actualmente</h2>
                                <a href="{{ route('mangas.estados') }}" class="text-blue-400 hover:text-blue-300 text-sm transition-colors duration-200">Ver todos</a>
                            </div>
                            <div class="space-y-4">
                                @foreach (auth()->user()->mangasLeyendo()->take(5)->get() as $manga)
                                    <div class="flex items-center space-x-4 bg-[#1a1f2c] p-4 rounded-lg hover:bg-[#2e3444] transition-all duration-200 border border-[#2e3444] hover:border-blue-500/50">
                                        <img src="{{ $manga->imagen_portada }}" alt="{{ $manga->titulo }}" class="w-16 h-24 object-cover rounded shadow-md hover:shadow-lg transition-shadow duration-200">
                                        <div class="flex-1">
                                            <h3 class="text-gray-100 font-semibold hover:text-blue-400 transition-colors duration-200">{{ $manga->titulo }}</h3>
                                            <p class="text-gray-400 text-sm">{{ Str::limit($manga->descripcion, 100) }}</p>
                                        </div>
                                        <a href="{{ route('mangas.show', $manga) }}" class="text-blue-400 hover:text-blue-300 transition-colors duration-200">
                                            <i class="fas fa-arrow-right"></i>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <!-- Actividad Reciente -->
                    <div class="lg:col-span-1">
                        <div class="bg-[#242937] backdrop-blur-md rounded-lg shadow-xl p-6 border border-[#2e3444]">
                            <h2 class="text-2xl font-semibold text-white bg-clip-text text-transparent bg-gradient-to-r from-blue-400 to-indigo-400 inline-block mb-6">Actividad Reciente</h2>
                            <div class="space-y-4">
                                @foreach (auth()->user()->mangasConEstado()->latest('manga_user_states.updated_at')->take(5)->get() as $manga)
                                    <div class="flex items-center space-x-3 text-sm bg-[#1a1f2c] p-3 rounded-lg border border-[#2e3444]">
                                        <div class="flex-shrink-0">
                                            @switch($manga->pivot->state)
                                                @case('leido')
                                                    <span class="w-8 h-8 flex items-center justify-center bg-blue-500/10 text-blue-400 rounded-lg backdrop-blur-sm">
                                                        <i class="fas fa-book-reader"></i>
                                                    </span>
                                                @break

                                                @case('leyendo')
                                                    <span class="w-8 h-8 flex items-center justify-center bg-indigo-500/10 text-indigo-400 rounded-lg backdrop-blur-sm">
                                                        <i class="fas fa-book-open"></i>
                                                    </span>
                                                @break

                                                @case('pendiente')
                                                    <span class="w-8 h-8 flex items-center justify-center bg-blue-500/10 text-blue-400 rounded-lg backdrop-blur-sm">
                                                        <i class="fas fa-clock"></i>
                                                    </span>
                                                @break

                                                @default
                                                    <span class="w-8 h-8 flex items-center justify-center bg-indigo-500/10 text-indigo-400 rounded-lg backdrop-blur-sm">
                                                        <i class="fas fa-times-circle"></i>
                                                    </span>
                                            @endswitch
                                        </div>
                                        <div class="flex-1">
                                            <p class="text-gray-300">
                                                Marcaste <span class="text-gray-100 font-medium hover:text-blue-400 transition-colors duration-200">{{ $manga->titulo }}</span> como
                                                <span class="@switch($manga->pivot->state)
                                                    @case('leido') text-blue-400 @break
                                                    @case('leyendo') text-indigo-400 @break
                                                    @case('pendiente') text-blue-400 @break
                                                    @default text-indigo-400
                                                @endswitch font-medium">
                                                    {{ $manga->pivot->state }}
                                                </span>
                                            </p>
                                            <p class="text-gray-500 text-xs">{{ $manga->pivot->updated_at->diffForHumans() }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- Géneros Favoritos -->
                        <div class="bg-[#242937] backdrop-blur-md rounded-lg shadow-xl p-6 border border-[#2e3444] mt-6">
                            <h2 class="text-2xl font-semibold text-white bg-clip-text text-transparent bg-gradient-to-r from-blue-400 to-indigo-400 inline-block mb-6">Tus Géneros Favoritos</h2>
                            <div class="space-y-3">
                                @php
                                    $generos = \App\Models\Genero::withCount([
                                        'mangas' => function ($query) {
                                            $query->whereHas('usuariosConEstado', function ($q) {
                                                $q->where('user_id', auth()->id());
                                            });
                                        },
                                    ])
                                        ->orderByDesc('mangas_count')
                                        ->take(5)
                                        ->get();
                                @endphp

                                @foreach ($generos as $genero)
                                    <div class="flex items-center justify-between bg-[#1a1f2c] p-3 rounded-lg border border-[#2e3444] hover:border-blue-500/50 transition-all duration-200">
                                        <span class="text-gray-300 font-medium">{{ $genero->nombre }}</span>
                                        <span class="text-blue-400 text-sm">{{ $genero->mangas_count }} mangas</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
