<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Autores') }}
            </h2>
            @can('admin')
            <a href="{{ route('authors.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Nuevo Autor
            </a>
            @endcan
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="overflow-x-auto">
                        <table class="w-full table-auto">
                            <thead>
                                <tr class="bg-gray-100 dark:bg-gray-700">
                                    <th class="w-1/4 px-4 py-2 text-left">Nombre</th>
                                    <th class="w-2/4 px-4 py-2 text-left">Biografía</th>
                                    <th class="w-1/12 px-4 py-2 text-center">Mangas</th>
                                    <th class="w-1/6 px-4 py-2 text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($autores as $autor)
                                <tr class="border-b dark:border-gray-700">
                                    <td class="px-4 py-3">
                                        <div class="font-medium">
                                            {{ $autor->nombre }}
                                        </div>
                                    </td>
                                    <td class="px-4 py-3">
                                        <div class="line-clamp-2">
                                            {{ $autor->biografia }}
                                        </div>
                                    </td>
                                    <td class="px-4 py-3 text-center">
                                        {{ $autor->mangas->count() }}
                                    </td>
                                    <td class="px-4 py-3 text-center">
                                        <div class="flex justify-center space-x-3">
                                            <a href="{{ route('authors.show', ['author' => $autor]) }}" 
                                               class="text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300">
                                                Ver
                                            </a>
                                            @can('admin')
                                            <a href="{{ route('authors.edit', ['author' => $autor]) }}" 
                                               class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300">
                                                Editar
                                            </a>
                                            <form action="{{ route('authors.destroy', ['author' => $autor]) }}" 
                                                  method="POST" 
                                                  class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300"
                                                        onclick="return confirm('¿Estás seguro de que quieres eliminar este autor?')">
                                                    Eliminar
                                                </button>
                                            </form>
                                            @endcan
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 