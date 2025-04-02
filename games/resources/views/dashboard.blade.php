@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-gray-900">
        <div class="py-6">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Header -->
                <div class="mb-8">
                    <h1 class="text-3xl font-bold text-white">Dashboard</h1>
                    <p class="mt-2 text-gray-200">Bienvenido a tu biblioteca de manga personal</p>
                </div>

                <!-- Stats Overview -->
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                    <div class="rounded-lg p-6 hover:bg-blue-600 transition-colors duration-200">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-lg text-white">Mangas Leídos</p>
                                <h3 class="text-3xl font-bold text-white mt-2">{{ auth()->user()->mangasLeidos()->count() }}
                                </h3>
                            </div>
                            <div class="bg-blue-400 p-3 rounded-lg">
                                <i class="fas fa-book-reader text-2xl text-white"></i>
                            </div>
                        </div>
                    </div>

                    <div class="bg-green-200 rounded-lg p-6 hover:bg-green-300 transition-colors duration-200">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-lg text-white">Leyendo Actualmente</p>
                                <h3 class="text-3xl font-bold text-white mt-2">
                                    {{ auth()->user()->mangasLeyendo()->count() }}</h3>
                            </div>
                            <div class="bg-sky-400 p-3 rounded-lg">
                                <i class="fas fa-book-open text-2xl text-white"></i>
                            </div>
                        </div>
                    </div>

                    <div class="rounded-lg p-6 hover:bg-yellow-600 transition-colors duration-200">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-lg text-white">Lista de Pendientes</p>
                                <h3 class="text-3xl font-bold text-white mt-2">
                                    {{ auth()->user()->mangasPendientes()->count() }}</h3>
                            </div>
                            <div class="bg-yellow-400 p-3 rounded-lg">
                                <i class="fas fa-clock text-2xl text-white"></i>
                            </div>
                        </div>
                    </div>

                    <div class="bg-purple-900 rounded-lg p-6 hover:bg-purple-600 transition-colors duration-200">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-lg text-white">Total de Mangas</p>
                                <h3 class="text-3xl font-bold text-white mt-2">
                                    {{ auth()->user()->mangasLeidos()->count() +
                                        auth()->user()->mangasLeyendo()->count() +
                                        auth()->user()->mangasPendientes()->count() }}
                                </h3>
                            </div>
                            <div class="bg-purple-400 p-3 rounded-lg">
                                <i class="fas fa-books text-2xl text-white"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Main Content -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <!-- Leyendo Actualmente -->
                    <div class="lg:col-span-2">
                        <div class="bg-gray-800 rounded-lg shadow-xl p-6">
                            <div class="flex justify-between items-center mb-6">
                                <h2 class="text-xl font-semibold text-white">Leyendo Actualmente</h2>
                                <a href="{{ route('mangas.estados') }}"
                                    class="text-blue-300 hover:text-blue-200 text-sm">Ver todos</a>
                            </div>
                            <div class="space-y-4">
                                @foreach (auth()->user()->mangasLeyendo()->take(5)->get() as $manga)
                                    <div
                                        class="flex items-center space-x-4 bg-gray-700/50 p-4 rounded-lg hover:bg-gray-700 transition-colors duration-200">
                                        <img src="{{ $manga->imagen_portada }}" alt="{{ $manga->titulo }}"
                                            class="w-16 h-24 object-cover rounded">
                                        <div class="flex-1">
                                            <h3 class="text-white font-semibold">{{ $manga->titulo }}</h3>
                                            <p class="text-gray-200 text-sm">{{ Str::limit($manga->descripcion, 100) }}</p>
                                        </div>
                                        <a href="{{ route('mangas.show', $manga) }}"
                                            class="text-blue-300 hover:text-blue-200">
                                            <i class="fas fa-arrow-right"></i>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <!-- Actividad Reciente -->
                    <div class="lg:col-span-1">
                        <div class="bg-gray-800 rounded-lg shadow-xl p-6">
                            <h2 class="text-xl font-semibold text-white mb-6">Actividad Reciente</h2>
                            <div class="space-y-4">
                                @foreach (auth()->user()->mangasConEstado()->latest('manga_user_states.updated_at')->take(5)->get() as $manga)
                                    <div class="flex items-center space-x-3 text-sm">
                                        <div class="flex-shrink-0">
                                            @switch($manga->pivot->state)
                                                @case('leido')
                                                    <span
                                                        class="w-8 h-8 flex items-center justify-center bg-blue-500/20 text-blue-300 rounded-lg">
                                                        <i class="fas fa-book-reader"></i>
                                                    </span>
                                                @break

                                                @case('leyendo')
                                                    <span
                                                        class="w-8 h-8 flex items-center justify-center bg-green-500/20 text-green-300 rounded-lg">
                                                        <i class="fas fa-book-open"></i>
                                                    </span>
                                                @break

                                                @case('pendiente')
                                                    <span
                                                        class="w-8 h-8 flex items-center justify-center bg-yellow-500/20 text-yellow-300 rounded-lg">
                                                        <i class="fas fa-clock"></i>
                                                    </span>
                                                @break

                                                @default
                                                    <span
                                                        class="w-8 h-8 flex items-center justify-center bg-red-500/20 text-red-300 rounded-lg">
                                                        <i class="fas fa-times-circle"></i>
                                                    </span>
                                            @endswitch
                                        </div>
                                        <div class="flex-1">
                                            <p class="text-gray-200">
                                                Marcaste <span class="text-white font-medium">{{ $manga->titulo }}</span>
                                                como
                                                <span
                                                    class="@switch($manga->pivot->state)
                                                @case('leido') text-blue-300 @break
                                                @case('leyendo') text-green-300 @break
                                                @case('pendiente') text-yellow-300 @break
                                                @default text-red-300
                                            @endswitch">
                                                    {{ $manga->pivot->state }}
                                                </span>
                                            </p>
                                            <p class="text-gray-400 text-xs">
                                                {{ $manga->pivot->updated_at->diffForHumans() }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>


                    </div>
                    <!-- Géneros Favoritos -->
                    <div class="bg-gray-800 rounded-lg shadow-xl p-6">
                        <h2 class="text-xl font-semibold text-white mb-6">Tus Géneros Favoritos</h2>
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
                                <div class="flex items-center justify-between bg-gray-700/50 p-3 rounded-lg">
                                    <span class="text-gray-500">{{ $genero->nombre }}</span>
                                    <span class="text-gray-500 text-sm">{{ $genero->mangas_count }} mangas</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
