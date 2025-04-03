<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Mis Mangas') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            <!-- Mangas Leyendo -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold mb-4 text-gray-900 dark:text-gray-100 flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                        </svg>
                        Leyendo
                    </h3>
                    @if($mangasLeyendo->count() > 0)
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach($mangasLeyendo as $manga)
                                <div class="bg-gray-50 dark:bg-gray-700 rounded-lg shadow-md p-6 hover:shadow-lg transition-shadow duration-300">
                                    <div class="flex flex-col h-full justify-between space-y-4">
                                        <div class="space-y-3">
                                            <h4 class="text-lg font-semibold text-gray-900 dark:text-gray-100">{{ $manga->titulo }}</h4>
                                            <div class="space-y-1">
                                                <p class="text-sm text-gray-600 dark:text-gray-400">
                                                    <span class="font-medium">Autores:</span> 
                                                    {{ $manga->autores->pluck('nombre')->join(', ') }}
                                                </p>
                                                <p class="text-sm text-gray-600 dark:text-gray-400">
                                                    <span class="font-medium">Editorial:</span> 
                                                    {{ $manga->editorial->nombre }}
                                                </p>
                                            </div>
                                        </div>
                                        <div class="flex justify-between items-center space-x-2">
                                            <form action="{{ route('manga.state.update', $manga) }}" method="POST" class="inline-block">
                                                @csrf
                                                @method('PUT')
                                                <select name="state" onchange="this.form.submit()" 
                                                        class="rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white text-sm focus:border-indigo-500 focus:ring-indigo-500">
                                                    <option value="leyendo" selected>Leyendo</option>
                                                    <option value="leido">Leído</option>
                                                    <option value="pendiente">Pendiente</option>
                                                    <option value="abandonado">Abandonado</option>
                                                </select>
                                            </form>
                                            <form action="{{ route('mangas.eliminar-estado', $manga) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        class="inline-flex items-center px-3 py-1 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 focus:bg-red-700 active:bg-red-900 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-500 dark:text-gray-400">No tienes mangas en estado "Leyendo"</p>
                    @endif
                </div>
            </div>

            <!-- Mangas Leídos -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold mb-4 text-gray-900 dark:text-gray-100 flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Leídos
                    </h3>
                    @if($mangasLeidos->count() > 0)
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach($mangasLeidos as $manga)
                                <div class="bg-gray-50 dark:bg-gray-700 rounded-lg shadow-md p-6 hover:shadow-lg transition-shadow duration-300">
                                    <div class="flex flex-col h-full justify-between space-y-4">
                                        <div class="space-y-3">
                                            <h4 class="text-lg font-semibold text-gray-900 dark:text-gray-100">{{ $manga->titulo }}</h4>
                                            <div class="space-y-1">
                                                <p class="text-sm text-gray-600 dark:text-gray-400">
                                                    <span class="font-medium">Autores:</span> 
                                                    {{ $manga->autores->pluck('nombre')->join(', ') }}
                                                </p>
                                                <p class="text-sm text-gray-600 dark:text-gray-400">
                                                    <span class="font-medium">Editorial:</span> 
                                                    {{ $manga->editorial->nombre }}
                                                </p>
                                            </div>
                                        </div>
                                        <div class="flex justify-between items-center space-x-2">
                                            <form action="{{ route('manga.state.update', $manga) }}" method="POST" class="inline-block">
                                                @csrf
                                                @method('PUT')
                                                <select name="state" onchange="this.form.submit()" 
                                                        class="rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white text-sm focus:border-indigo-500 focus:ring-indigo-500">
                                                    <option value="leido" selected>Leído</option>
                                                    <option value="leyendo">Leyendo</option>
                                                    <option value="pendiente">Pendiente</option>
                                                    <option value="abandonado">Abandonado</option>
                                                </select>
                                            </form>
                                            <form action="{{ route('mangas.eliminar-estado', $manga) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        class="inline-flex items-center px-3 py-1 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 focus:bg-red-700 active:bg-red-900 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-500 dark:text-gray-400">No tienes mangas en estado "Leído"</p>
                    @endif
                </div>
            </div>

            <!-- Mangas Pendientes -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold mb-4 text-gray-900 dark:text-gray-100 flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Pendientes
                    </h3>
                    @if($mangasPendientes->count() > 0)
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach($mangasPendientes as $manga)
                                <div class="bg-gray-50 dark:bg-gray-700 rounded-lg shadow-md p-6 hover:shadow-lg transition-shadow duration-300">
                                    <div class="flex flex-col h-full justify-between space-y-4">
                                        <div class="space-y-3">
                                            <h4 class="text-lg font-semibold text-gray-900 dark:text-gray-100">{{ $manga->titulo }}</h4>
                                            <div class="space-y-1">
                                                <p class="text-sm text-gray-600 dark:text-gray-400">
                                                    <span class="font-medium">Autores:</span> 
                                                    {{ $manga->autores->pluck('nombre')->join(', ') }}
                                                </p>
                                                <p class="text-sm text-gray-600 dark:text-gray-400">
                                                    <span class="font-medium">Editorial:</span> 
                                                    {{ $manga->editorial->nombre }}
                                                </p>
                                            </div>
                                        </div>
                                        <div class="flex justify-between items-center space-x-2">
                                            <form action="{{ route('manga.state.update', $manga) }}" method="POST" class="inline-block">
                                                @csrf
                                                @method('PUT')
                                                <select name="state" onchange="this.form.submit()" 
                                                        class="rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white text-sm focus:border-indigo-500 focus:ring-indigo-500">
                                                    <option value="pendiente" selected>Pendiente</option>
                                                    <option value="leyendo">Leyendo</option>
                                                    <option value="leido">Leído</option>
                                                    <option value="abandonado">Abandonado</option>
                                                </select>
                                            </form>
                                            <form action="{{ route('mangas.eliminar-estado', $manga) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        class="inline-flex items-center px-3 py-1 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 focus:bg-red-700 active:bg-red-900 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-500 dark:text-gray-400">No tienes mangas en estado "Pendiente"</p>
                    @endif
                </div>
            </div>

            <!-- Mangas Abandonados -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold mb-4 text-gray-900 dark:text-gray-100 flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Abandonados
                    </h3>
                    @if($mangasAbandonados->count() > 0)
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach($mangasAbandonados as $manga)
                                <div class="bg-gray-50 dark:bg-gray-700 rounded-lg shadow-md p-6 hover:shadow-lg transition-shadow duration-300">
                                    <div class="flex flex-col h-full justify-between space-y-4">
                                        <div class="space-y-3">
                                            <h4 class="text-lg font-semibold text-gray-900 dark:text-gray-100">{{ $manga->titulo }}</h4>
                                            <div class="space-y-1">
                                                <p class="text-sm text-gray-600 dark:text-gray-400">
                                                    <span class="font-medium">Autores:</span> 
                                                    {{ $manga->autores->pluck('nombre')->join(', ') }}
                                                </p>
                                                <p class="text-sm text-gray-600 dark:text-gray-400">
                                                    <span class="font-medium">Editorial:</span> 
                                                    {{ $manga->editorial->nombre }}
                                                </p>
                                            </div>
                                        </div>
                                        <div class="flex justify-between items-center space-x-2">
                                            <form action="{{ route('manga.state.update', $manga) }}" method="POST" class="inline-block">
                                                @csrf
                                                @method('PUT')
                                                <select name="state" onchange="this.form.submit()" 
                                                        class="rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white text-sm focus:border-indigo-500 focus:ring-indigo-500">
                                                    <option value="abandonado" selected>Abandonado</option>
                                                    <option value="leyendo">Leyendo</option>
                                                    <option value="leido">Leído</option>
                                                    <option value="pendiente">Pendiente</option>
                                                </select>
                                            </form>
                                            <form action="{{ route('mangas.eliminar-estado', $manga) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        class="inline-flex items-center px-3 py-1 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 focus:bg-red-700 active:bg-red-900 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-500 dark:text-gray-400">No tienes mangas en estado "Abandonado"</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 