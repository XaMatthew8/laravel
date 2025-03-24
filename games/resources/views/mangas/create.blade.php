<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Nuevo Manga') }}
            </h2>
            <a href="{{ route('mangas.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                Volver
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('mangas.store') }}" method="POST" class="space-y-6">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Información Básica -->
                            <div class="space-y-6">
                                <div>
                                    <label for="titulo" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                        Título *
                                    </label>
                                    <input type="text" name="titulo" id="titulo" required
                                        class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                </div>

                                <div>
                                    <label for="descripcion" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                        Descripción *
                                    </label>
                                    <textarea name="descripcion" id="descripcion" rows="4" required
                                        class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"></textarea>
                                </div>

                                <div>
                                    <label for="fecha_publicacion" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                        Fecha de Publicación *
                                    </label>
                                    <input type="date" name="fecha_publicacion" id="fecha_publicacion" required
                                        class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                </div>

                                <div>
                                    <label for="precio" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                        Precio *
                                    </label>
                                    <div class="mt-1 relative rounded-md shadow-sm">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <span class="text-gray-500 dark:text-gray-400 sm:text-sm">€</span>
                                        </div>
                                        <input type="number" name="precio" id="precio" step="0.01" required
                                            class="pl-7 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    </div>
                                </div>
                            </div>

                            <!-- Relaciones -->
                            <div class="space-y-6">
                                <div>
                                    <label for="editorial_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                        Editorial *
                                    </label>
                                    <select name="editorial_id" id="editorial_id" required
                                        class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                        <option value="">Selecciona una editorial</option>
                                        @foreach($editoriales as $editorial)
                                            <option value="{{ $editorial->id }}">{{ $editorial->nombre }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div>
                                    <label for="autores" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                        Autores *
                                    </label>
                                    <select name="autores[]" id="autores" multiple required
                                        class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                        @foreach($autores as $autor)
                                            <option value="{{ $autor->id }}">{{ $autor->nombre }}</option>
                                        @endforeach
                                    </select>
                                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                                        Mantén presionado Ctrl (Cmd en Mac) para seleccionar múltiples autores
                                    </p>
                                </div>

                                <div>
                                    <label for="generos" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                        Géneros *
                                    </label>
                                    <select name="generos[]" id="generos" multiple required
                                        class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                        @foreach($generos as $genero)
                                            <option value="{{ $genero->id }}">{{ $genero->nombre }}</option>
                                        @endforeach
                                    </select>
                                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                                        Mantén presionado Ctrl (Cmd en Mac) para seleccionar múltiples géneros
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="flex justify-end mt-6">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Crear Manga
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 