@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-900 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-gray-800 rounded-lg shadow-xl overflow-hidden">
            <div class="p-6">
                <!-- Cabecera con tipo y rating -->
                <div class="flex justify-between items-center mb-6">
                    <div class="flex items-center gap-4">
                        <span class="bg-blue-600 text-white px-4 py-1 rounded-full text-sm">
                            MANGA
                        </span>
                        @if(auth()->user() && auth()->user()->admin)
                            <a href="{{ route('mangas.edit', $manga) }}" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-1 rounded-full text-sm transition duration-200">
                                <i class="fas fa-edit mr-2"></i>Editar Manga
                            </a>
                            <form action="{{ route('mangas.destroy', $manga) }}" method="POST" class="inline" onsubmit="return confirm('¿Estás seguro de que quieres eliminar este manga?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-4 py-1 rounded-full text-sm transition duration-200">
                                    <i class="fas fa-trash-alt mr-2"></i>Eliminar Manga
                                </button>
                            </form>
                        @endif
                    </div>
                    <div class="flex items-center bg-gray-900 px-4 py-2 rounded-full">
                        <i class="fas fa-star text-yellow-400 mr-2"></i>
                        <span class="text-white font-bold">{{ number_format($manga->rating, 2) }}</span>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-12 gap-8">
                    <!-- Columna Izquierda: Imagen y Estadísticas -->
                    <div class="md:col-span-auto">
                        <div class="flex gap-6">
                            <div class="relative w-[350px] h-[500px]">
                                <img 
                                    src="{{ $manga->imagen_portada ?: 'https://placehold.co/350x500/1F2937/FFFFFF/png?text=No+Image' }}" 
                                    alt="{{ $manga->titulo }}"
                                    class="w-[350px] h-[500px] object-cover rounded-lg shadow-lg"
                                >
                            </div>

                            
                            <div class="md:col-span-auto flex-1">
                                <div>
                                    <h1 class="text-3xl font-bold text-white mb-4">{{ $manga->titulo }}</h1>
        
                                    <!-- Géneros -->
                                    <div class="flex flex-wrap gap-2">
                                        @foreach($manga->generos as $genero)
                                            <span class="bg-indigo-600 text-white px-3 py-1 rounded-full text-sm">
                                                {{ $genero->nombre }}
                                            </span>
                                        @endforeach
                                    </div>
                                </div>
        
                                <!-- Descripción -->
                                <div class="bg-gray-900 rounded-lg p-6 mt-6">
                                    <h3 class="text-xl font-semibold text-white mb-4">Sinopsis</h3>
                                    <p class="text-gray-300 leading-relaxed">
                                        {{ $manga->descripcion }}
                                    </p>
                                </div>
        
                                <!-- Información Adicional -->
                                <div class="bg-gray-900 rounded-lg p-6 mt-6">
                                    <h3 class="text-xl font-semibold text-white mb-4">Información</h3>
                                    <div class="grid grid-cols-2 gap-4">
                                        <div>
                                            <h4 class="text-gray-400">Editorial</h4>
                                            <p class="text-white">{{ $manga->editorial->nombre }}</p>
                                        </div>
                                        <div>
                                            <h4 class="text-gray-400">Fecha de Publicación</h4>
                                            <p class="text-white">{{ $manga->fecha_publicacion->format('d/m/Y') }}</p>
                                        </div>
                                        <div class="col-span-2">
                                            <h4 class="text-gray-400">Autores</h4>
                                            <p class="text-white">
                                                @foreach($manga->autores as $autor)
                                                    {{ $autor->nombre }}{{ !$loop->last ? ', ' : '' }}
                                                @endforeach
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="flex-1 flex flex-col justify-between">
                                <!-- Estados del Manga -->
                                <div class="space-y-4">
                                    <!-- Leídos -->
                                    <div class="@if($estadoActual === 'leido') bg-blue-900/60 @else bg-gray-900/60 @endif rounded-lg p-4 hover:bg-blue-900/40 transition-colors duration-200">
                                        <div class="flex items-center justify-between mb-2">
                                            <span class="@if($estadoActual === 'leido') text-blue-200 @else text-gray-300 @endif text-sm">Leídos</span>
                                            <span class="text-blue-400 font-bold">{{ $estadisticas['leidos'] }}</span>
                                        </div>
                                        <form action="{{ route('mangas.cambiar-estado', $manga) }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="estado" value="leido">
                                            <button type="submit" class="w-full bg-blue-600/80 hover:bg-blue-700 text-white text-sm py-2 px-4 rounded transition duration-200">
                                                <i class="fas fa-book-reader mr-2"></i> @if($estadoActual === 'leido') Leído @else Marcar como Leído @endif
                                            </button>
                                        </form>
                                    </div>

                                    <!-- Leyendo -->
                                    <div class="@if($estadoActual === 'leyendo') bg-green-900/60 @else bg-gray-900/60 @endif rounded-lg p-4 hover:bg-green-900/40 transition-colors duration-200">
                                        <div class="flex items-center justify-between mb-2">
                                            <span class="@if($estadoActual === 'leyendo') text-green-200 @else text-gray-300 @endif text-sm">Leyendo</span>
                                            <span class="text-green-400 font-bold">{{ $estadisticas['leyendo'] }}</span>
                                        </div>
                                        <form action="{{ route('mangas.cambiar-estado', $manga) }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="estado" value="leyendo">
                                            <button type="submit" class="w-full bg-green-600/80 hover:bg-green-700 text-white text-sm py-2 px-4 rounded transition duration-200">
                                                <i class="fas fa-book-open mr-2"></i> @if($estadoActual === 'leyendo') Leyendo @else Estoy Leyendo @endif
                                            </button>
                                        </form>
                                    </div>

                                    <!-- Pendientes -->
                                    <div class="@if($estadoActual === 'pendiente') bg-yellow-900/60 @else bg-gray-900/60 @endif rounded-lg p-4 hover:bg-yellow-900/40 transition-colors duration-200">
                                        <div class="flex items-center justify-between mb-2">
                                            <span class="@if($estadoActual === 'pendiente') text-yellow-200 @else text-gray-300 @endif text-sm">Pendientes</span>
                                            <span class="text-yellow-400 font-bold">{{ $estadisticas['pendientes'] }}</span>
                                        </div>
                                        <form action="{{ route('mangas.cambiar-estado', $manga) }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="estado" value="pendiente">
                                            <button type="submit" class="w-full bg-yellow-600/80 hover:bg-yellow-700 text-white text-sm py-2 px-4 rounded transition duration-200">
                                                <i class="fas fa-clock mr-2"></i> @if($estadoActual === 'pendiente') En Pendientes @else Añadir a Pendientes @endif
                                            </button>
                                        </form>
                                    </div>

                                    <!-- Abandonados -->
                                    <div class="@if($estadoActual === 'abandonado') bg-red-900/60 @else bg-gray-900/60 @endif rounded-lg p-4 hover:bg-red-900/40 transition-colors duration-200">
                                        <div class="flex items-center justify-between mb-2">
                                            <span class="@if($estadoActual === 'abandonado') text-red-200 @else text-gray-300 @endif text-sm">Abandonados</span>
                                            <span class="text-red-400 font-bold">{{ $estadisticas['abandonados'] }}</span>
                                        </div>
                                        <form action="{{ route('mangas.cambiar-estado', $manga) }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="estado" value="abandonado">
                                            <button type="submit" class="w-full bg-red-600/80 hover:bg-red-700 text-white text-sm py-2 px-4 rounded transition duration-200">
                                                <i class="fas fa-times-circle mr-2"></i> @if($estadoActual === 'abandonado') Abandonado @else Abandonar @endif
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Columna Derecha: Información -->
                   
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 