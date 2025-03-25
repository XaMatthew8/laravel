<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Editar Autor') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-[#1a1f2c] overflow-hidden shadow-xl rounded-lg">
                <div class="p-6">
                    <form action="{{ route('autores.update', ['autor' => $autor]) }}" method="POST" class="space-y-4">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label for="nombre" class="block text-sm font-medium text-white mb-2">Nombre</label>
                            <input type="text" 
                                   name="nombre" 
                                   id="nombre" 
                                   value="{{ old('nombre', $autor->nombre) }}"
                                   class="w-full px-3 py-2 bg-white border border-gray-300 rounded-lg text-gray-900 focus:outline-none focus:border-indigo-500 @error('nombre') border-red-500 @enderror">
                            @error('nombre')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="biografia" class="block text-sm font-medium text-white mb-2">Biografía</label>
                            <textarea name="biografia" 
                                      id="biografia" 
                                      rows="4"
                                      class="w-full px-3 py-2 bg-white border border-gray-300 rounded-lg text-gray-900 focus:outline-none focus:border-indigo-500 @error('biografia') border-red-500 @enderror">{{ old('biografia', $autor->biografia) }}</textarea>
                            @error('biografia')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex justify-end space-x-4">
                            <a href="{{ route('autores.index') }}" 
                               class="px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white rounded-lg transition duration-300">
                                Cancelar
                            </a>
                            <button type="submit" 
                                    class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg transition duration-300">
                                Actualizar Autor
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 