@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-200">Mis Estados de Manga</h1>
        <a href="{{ route('mangas.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg transition duration-300 flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
            </svg>
            Volver
        </a>
    </div>

    @if($mangas->isEmpty())
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 text-center">
            <p class="text-gray-600 dark:text-gray-300">No tienes ningún manga en tu lista de estados.</p>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($mangas as $manga)
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden">
                    <div class="p-6">
                        <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200 mb-2">{{ $manga->titulo }}</h2>
                        
                        <div class="space-y-2">
                            <p class="text-gray-600 dark:text-gray-300">
                                <span class="font-medium">Autores:</span>
                                {{ $manga->autores->pluck('nombre')->join(', ') }}
                            </p>
                            
                            <p class="text-gray-600 dark:text-gray-300">
                                <span class="font-medium">Editorial:</span>
                                {{ $manga->editorial->nombre }}
                            </p>
                            
                            <p class="text-gray-600 dark:text-gray-300">
                                <span class="font-medium">Géneros:</span>
                                {{ $manga->generos->pluck('name')->join(', ') }}
                            </p>
                        </div>

                        @if($manga->usuariosConEstado->isNotEmpty())
                            <div class="mt-4">
                                <p class="text-gray-600 dark:text-gray-300">
                                    <span class="font-medium">Tu estado:</span>
                                    {{ $manga->usuariosConEstado->first()->pivot->estado }}
                                </p>
                            </div>
                        @endif

                        <div class="mt-6 flex justify-end">
                            <a href="{{ route('mangas.show', $manga) }}" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg transition duration-300">
                                Ver Detalles
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection 