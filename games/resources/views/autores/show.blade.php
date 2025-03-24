<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ $autor->nombre }}
            </h2>
            <div class="flex space-x-4">
                <a href="{{ route('authors.edit', ['author' => $autor]) }}" class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">
                    {{ __('Editar Autor') }}
                </a>
                <a href="{{ route('authors.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
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
                                    <p class="mb-2"><span class="font-medium">Nombre:</span> {{ $autor->nombre }}</p>
                                    <p class="mb-2"><span class="font-medium">Biografía:</span> {{ $autor->biografia }}</p>
                                    <p class="mb-2"><span class="font-medium">Fecha de Nacimiento:</span> {{ $autor->fecha_nacimiento }}</p>
                                    <p class="mb-2"><span class="font-medium">Nacionalidad:</span> {{ $autor->nacionalidad }}</p>
                                </div>
                            </div>

                            <!-- Estadísticas -->
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-2">Estadísticas</h3>
                                <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-4">
                                    <p class="mb-2"><span class="font-medium">Total de Mangas:</span> {{ $autor->mangas->count() }}</p>
                                    <p class="mb-2"><span class="font-medium">Promedio de Reseñas:</span> 
                                        @if($autor->mangas->count() > 0)
                                            {{ number_format($autor->mangas->flatMap->reseñas->avg('puntuacion'), 1) }}
                                        @else
                                            N/A
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Mangas del Autor -->
                        <div class="space-y-6">
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-2">Mangas Publicados</h3>
                                <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-4">
                                    @if($autor->mangas->count() > 0)
                                        <div class="space-y-4">
                                            @foreach($autor->mangas as $manga)
                                                <div class="border-b border-gray-200 dark:border-gray-600 pb-4 last:border-0">
                                                    <div class="flex justify-between items-start">
                                                        <div>
                                                            <a href="{{ route('mangas.show', $manga) }}" class="text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300 font-medium">
                                                                {{ $manga->titulo }}
                                                            </a>
                                                            <p class="text-sm text-gray-500 dark:text-gray-400">{{ $manga->fecha_publicacion }}</p>
                                                        </div>
                                                        <div class="flex items-center">
                                                            @if($manga->reseñas->count() > 0)
                                                                <span class="text-sm text-gray-500 dark:text-gray-400">
                                                                    {{ number_format($manga->reseñas->avg('puntuacion'), 1) }} ★
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <p class="mt-2 text-sm text-gray-600 dark:text-gray-300">
                                                        {{ Str::limit($manga->descripcion, 100) }}
                                                    </p>
                                                </div>
                                            @endforeach
                                        </div>
                                    @else
                                        <p class="text-gray-500 dark:text-gray-400">No hay mangas publicados</p>
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