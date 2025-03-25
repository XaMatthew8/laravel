<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Editoriales') }}
            </h2>
            @can('admin')
            <a href="{{ route('editorials.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Nueva Editorial
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
                                    <th class="w-1/3 px-4 py-2 text-left">Nombre</th>
                                    <th class="w-1/3 px-4 py-2 text-left">Descripción</th>
                                    <th class="w-1/6 px-4 py-2 text-center">Mangas</th>
                                    <th class="w-1/6 px-4 py-2 text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                                @foreach($editoriales as $editorial)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                                    <td class="px-4 py-3">
                                        <div class="font-medium">
                                            {{ $editorial->nombre }}
                                        </div>
                                    </td>
                                    <td class="px-4 py-3">
                                        <div class="line-clamp-2">
                                            {{ $editorial->descripcion }}
                                        </div>
                                    </td>
                                    <td class="px-4 py-3">
                                        <div class="flex justify-center">
                                            <span class="w-8 text-center font-medium">
                                                {{ $editorial->mangas->count() }}
                                            </span>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3">
                                        <div class="flex items-center justify-center space-x-3">
                                            <a href="{{ route('editorials.show', ['editorial' => $editorial]) }}" 
                                               class="text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300">
                                                Ver
                                            </a>
                                            @can('admin')
                                            <a href="{{ route('editorials.edit', ['editorial' => $editorial]) }}" 
                                               class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300">
                                                Editar
                                            </a>
                                            <form action="{{ route('editorials.destroy', ['editorial' => $editorial]) }}" 
                                                  method="POST" 
                                                  class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300"
                                                        onclick="return confirm('¿Estás seguro de que quieres eliminar esta editorial?')">
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