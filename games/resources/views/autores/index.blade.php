<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-white leading-tight">
                {{ __('Autores') }}
            </h2>
            @if(Auth::check() && Auth::user()->admin == 1)
                <a href="{{ route('autores.create') }}" 
                   class="bg-gray-700 hover:bg-gray-600 text-white px-6 py-2 rounded transition duration-300 inline-flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Nuevo Autor
                </a>
            @endif
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="bg-gray-700 text-white px-4 py-3 rounded mb-6">
                    {{ session('success') }}
                </div>
            @endif

            @if($autores->isEmpty())
                <div class="bg-[#1a1f2c] rounded p-8 text-center">
                    <svg class="w-16 h-16 mx-auto text-gray-500 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                    <p class="text-white text-lg">No hay autores registrados.</p>
                    @if(Auth::check() && Auth::user()->admin == 1)
                        <p class="text-gray-500 mt-2">¿Por qué no agregas uno nuevo?</p>
                    @endif
                </div>
            @else
                <div class="bg-[#1a1f2c] rounded overflow-hidden shadow-xl">
                    <table class="min-w-full divide-y divide-gray-800">
                        <thead>
                            <tr class="bg-[#151922]">
                                <th class="px-6 py-4 text-left text-xs font-medium text-white uppercase tracking-wider">Título</th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-white uppercase tracking-wider">Autor</th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-white uppercase tracking-wider">Mangas</th>
                                <th class="px-6 py-4 text-right text-xs font-medium text-white uppercase tracking-wider">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-800">
                            @foreach($autores as $autor)
                                <tr class="hover:bg-[#1f2937] transition-colors">
                                    <td class="px-6 py-4">
                                        <span class="text-white">{{ $autor->nombre }}</span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <p class="text-gray-500 truncate max-w-xs">{{ $autor->biografia }}</p>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="bg-[#1f2937] text-white text-xs px-2.5 py-1 rounded">
                                            {{ $autor->mangas->count() }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex justify-end space-x-3">
                                            <a href="{{ route('autores.mangas', $autor) }}" 
                                               class="text-white hover:text-gray-500 px-3"
                                               title="Ver">
                                                Ver
                                            </a>
                                            @if(Auth::check() && Auth::user()->admin == 1)
                                                <a href="{{ route('autores.edit', $autor) }}" 
                                                   class="text-white hover:text-gray-500 px-3"
                                                   title="Editar">
                                                    Editar
                                                </a>
                                                <form action="{{ route('autores.destroy', $autor) }}" method="POST" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" 
                                                            class="text-white hover:text-gray-500 px-3"
                                                            onclick="return confirm('¿Estás seguro de que deseas eliminar este autor?')"
                                                            title="Eliminar">
                                                        Eliminar
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</x-app-layout> 