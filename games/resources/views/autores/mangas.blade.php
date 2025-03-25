@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-7xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-white">Mangas de {{ $author->nombre }}</h1>
            <a href="{{ route('autores.show', $author) }}" class="text-indigo-400 hover:text-indigo-300">
                Volver al autor
            </a>
        </div>

        @if($mangas->isEmpty())
            <div class="bg-gray-800 rounded-lg shadow-lg p-6 text-center">
                <p class="text-gray-300">Este autor no tiene mangas registrados.</p>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($mangas as $manga)
                    <div class="bg-gray-800 rounded-lg shadow-lg overflow-hidden">
                        @if($manga->imagen)
                            <img src="{{ asset('storage/' . $manga->imagen) }}" 
                                 alt="{{ $manga->titulo }}" 
                                 class="w-full h-48 object-cover">
                        @endif
                        <div class="p-4">
                            <h2 class="text-xl font-semibold text-white mb-2">{{ $manga->titulo }}</h2>
                            <p class="text-gray-300 text-sm mb-2">{{ Str::limit($manga->descripcion, 100) }}</p>
                            <div class="flex justify-between items-center text-sm text-gray-400">
                                <span>Género: {{ $manga->genero->nombre }}</span>
                                <span>Editorial: {{ $manga->editorial->nombre }}</span>
                            </div>
                            <div class="mt-4">
                                <a href="{{ route('mangas.show', $manga) }}" 
                                   class="block text-center bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg transition duration-300">
                                    Ver detalles
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
@endsection 