<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Lista de Mangas') }}
            </h2>
            @if(Auth::check())
                <!-- Debug info -->
                <div class="text-sm text-gray-500">
                    Es admin: {{ Auth::user()->admin ? 'Sí' : 'No' }}
                </div>
            @endif
            @if(Auth::check() && Auth::user()->admin == 1)
            <a href="{{ route('mangas.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded inline-flex items-center">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Nuevo Manga
            </a>
            @endif
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead class="bg-gray-50 dark:bg-gray-700">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Título
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Autor
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Editorial
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Género
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Estado
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Acciones
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                @foreach($mangas as $manga)
                                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-medium text-gray-900 dark:text-gray-100">
                                                {{ $manga->titulo }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-500 dark:text-gray-400">
                                                {{ $manga->autores->pluck('nombre')->join(', ') ?? 'Sin autor' }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-500 dark:text-gray-400">
                                                {{ $manga->editorial->nombre ?? 'Sin editorial' }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-500 dark:text-gray-400">
                                                {{ $manga->generos->pluck('nombre')->join(', ') ?? 'Sin género' }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @auth
                                                <form action="{{ route('manga.state.update', $manga) }}" method="POST" class="inline">
                                                    @csrf
                                                    @method('PUT')
                                                    <select name="state" onchange="this.form.submit()" class="rounded border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white text-sm">
                                                        <option value="">Añadir a mi lista</option>
                                                        <option value="leyendo" {{ $manga->usuariosConEstado->first()?->pivot->state === 'leyendo' ? 'selected' : '' }}>Leyendo</option>
                                                        <option value="pendiente" {{ $manga->usuariosConEstado->first()?->pivot->state === 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                                                        <option value="leido" {{ $manga->usuariosConEstado->first()?->pivot->state === 'leido' ? 'selected' : '' }}>Leído</option>
                                                        <option value="abandonado" {{ $manga->usuariosConEstado->first()?->pivot->state === 'abandonado' ? 'selected' : '' }}>Abandonado</option>
                                                    </select>
                                                </form>
                                            @endauth
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <div class="flex space-x-6">
                                                <a href="{{ route('mangas.show', $manga) }}" class="text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300 px-3 py-1 rounded-md hover:bg-blue-50 dark:hover:bg-blue-900/20">
                                                    Ver
                                                </a>
                                                @if(Auth::check() && Auth::user()->admin == 1)
                                                <div class="flex space-x-2">
                                                    <a href="{{ route('mangas.edit', $manga) }}" class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300 px-3 py-1 rounded-md hover:bg-indigo-50 dark:hover:bg-indigo-900/20">
                                                        Editar
                                                    </a>
                                                    <form action="{{ route('mangas.destroy', $manga) }}" method="POST" class="inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300 px-3 py-1 rounded-md hover:bg-red-50 dark:hover:bg-red-900/20" onclick="return confirm('¿Estás seguro de que deseas eliminar este manga?')">
                                                            Eliminar
                                                        </button>
                                                    </form>
                                                </div>
                                                @endif
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