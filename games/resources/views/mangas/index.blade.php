@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4 bg-gray-900 min-h-screen">
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold text-gray-100">Biblioteca de Mangas</h1>
        @if (Auth::user() && Auth::user()->admin)
            <a href="{{ route('mangas.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                <i class="fas fa-plus mr-2"></i>
                Crear Manga
            </a>
        @endif
    </div>
    
    @foreach($mangasPorCategoria as $categoria)
    <div class="mb-12">
        <h2 class="text-2xl font-semibold mb-4 text-gray-100">{{ $categoria['categoria'] }}</h2>
        <div class="relative group">
            <!-- Botón Anterior -->
            <button 
                type="button"
                class="absolute left-0 top-1/2 -translate-y-1/2 bg-black/50 text-white p-3 rounded-r z-10 hover:bg-black/70 opacity-0 group-hover:opacity-100 transition-opacity duration-300 cursor-pointer"
                data-carousel="carousel-{{ Str::slug($categoria['categoria']) }}"
                data-direction="-1"
            >
                <i class="fas fa-chevron-left text-xl"></i>
            </button>

            <!-- Carrusel -->
            <div class="w-full overflow-hidden">
                <div 
                    id="carousel-{{ Str::slug($categoria['categoria']) }}" 
                    class="flex gap-6 overflow-x-auto whitespace-nowrap py-4 px-6 hide-scrollbar"
                    style="scroll-snap-type: x mandatory;"
                >
                    @foreach ($categoria['mangas'] as $manga)
                        <div class="inline-block flex-shrink-0" style="scroll-snap-align: start;">
                            <x-manga-card :manga="$manga" />
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Botón Siguiente -->
            <button 
                type="button"
                class="absolute right-0 top-1/2 -translate-y-1/2 bg-black/50 text-white p-3 rounded-l z-10 hover:bg-black/70 opacity-0 group-hover:opacity-100 transition-opacity duration-300 cursor-pointer"
                data-carousel="carousel-{{ Str::slug($categoria['categoria']) }}"
                data-direction="1"
            >
                <i class="fas fa-chevron-right text-xl"></i>
            </button>
        </div>
    </div>
    @endforeach
</div>

<style>
    .hide-scrollbar {
        -ms-overflow-style: none;  /* IE and Edge */
        scrollbar-width: none;     /* Firefox */
    }
    .hide-scrollbar::-webkit-scrollbar {
        display: none;            /* Chrome, Safari and Opera */
    }
</style>
@endsection 