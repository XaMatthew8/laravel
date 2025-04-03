<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-gray-900">
        <div class="min-h-screen">
            <!-- Hero Section -->
            <div class="relative bg-gradient-to-b from-gray-900 via-gray-800 to-gray-800">
                <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
                    <div class="text-center">
                        <h1 class="text-3xl md:text-5xl font-bold text-white mb-4">
                            Bienvenido a <span class="text-indigo-400">MangaWorld</span>
                        </h1>
                        <p class="text-lg text-gray-300 mb-6 max-w-2xl mx-auto">
                            Descubre, organiza y comparte tu colección de mangas favoritos. 
                            Únete a nuestra comunidad de amantes del manga.
                        </p>
                        <div class="flex justify-center space-x-4 mb-8">
                            <a href="{{ route('login') }}" class="inline-flex items-center px-5 py-2.5 border border-transparent text-base font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-150 ease-in-out">
                                <i class="fas fa-sign-in-alt mr-2"></i>
                                Iniciar Sesión
                            </a>
                            <a href="{{ route('register') }}" class="inline-flex items-center px-5 py-2.5 border border-transparent text-base font-medium rounded-md text-indigo-700 bg-white hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-150 ease-in-out">
                                <i class="fas fa-user-plus mr-2"></i>
                                Registrarse
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Features Section -->
            <div class="py-12 bg-gray-800">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="text-center mb-8">
                        <h2 class="text-2xl md:text-3xl font-bold text-white">Características Principales</h2>
                        <p class="mt-3 text-lg text-gray-300">Todo lo que necesitas para gestionar tu colección de mangas</p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <!-- Feature 1 -->
                        <div class="bg-gray-700 rounded-lg p-6 shadow-lg hover:shadow-xl transition-shadow duration-300">
                            <div class="text-indigo-400 mb-3">
                                <i class="fas fa-book-open text-3xl"></i>
                            </div>
                            <h3 class="text-lg font-semibold text-white mb-2">Organiza tu Colección</h3>
                            <p class="text-gray-300 text-sm">Mantén un registro de todos tus mangas y su estado de lectura.</p>
                        </div>

                        <!-- Feature 2 -->
                        <div class="bg-gray-700 rounded-lg p-6 shadow-lg hover:shadow-xl transition-shadow duration-300">
                            <div class="text-indigo-400 mb-3">
                                <i class="fas fa-star text-3xl"></i>
                            </div>
                            <h3 class="text-lg font-semibold text-white mb-2">Califica y Reseña</h3>
                            <p class="text-gray-300 text-sm">Comparte tus opiniones y descubre nuevas recomendaciones.</p>
                        </div>

                        <!-- Feature 3 -->
                        <div class="bg-gray-700 rounded-lg p-6 shadow-lg hover:shadow-xl transition-shadow duration-300">
                            <div class="text-indigo-400 mb-3">
                                <i class="fas fa-users text-3xl"></i>
                            </div>
                            <h3 class="text-lg font-semibold text-white mb-2">Comunidad Activa</h3>
                            <p class="text-gray-300 text-sm">Conecta con otros fans y comparte tu pasión por el manga.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Call to Action -->
            <div class="bg-indigo-600">
                <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8 lg:flex lg:items-center lg:justify-between">
                    <h2 class="text-2xl md:text-3xl font-extrabold tracking-tight text-white">
                        <span class="block">¿Listo para comenzar?</span>
                        <span class="block text-indigo-200 text-lg">Únete a nuestra comunidad hoy mismo.</span>
                    </h2>
                    <div class="mt-6 lg:mt-0 lg:flex-shrink-0">
                        <div class="inline-flex rounded-md shadow">
                            <a href="{{ route('register') }}" class="inline-flex items-center justify-center px-5 py-2.5 border border-transparent text-base font-medium rounded-md text-indigo-600 bg-white hover:bg-indigo-50">
                                <i class="fas fa-user-plus mr-2"></i>
                                Crear Cuenta
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <footer class="bg-gray-900">
                <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
                    <div class="text-center text-gray-400">
                        <p>&copy; {{ date('Y') }} MangaWorld. Todos los derechos reservados.</p>
                    </div>
                </div>
            </footer>
        </div>
    </body>
</html>
