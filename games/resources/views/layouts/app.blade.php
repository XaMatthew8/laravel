<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="bg-gray-900">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-gray-900 min-h-screen">
        <div class="min-h-screen bg-gray-900">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main class="bg-gray-900 min-h-screen">
                @hasSection('content')
                    @yield('content')
                @else
                    {{ $slot }}
                @endif
            </main>
        </div>

        <script>
            function scrollCarousel(carouselId, direction) {
                const carousel = document.getElementById(carouselId);
                const scrollAmount = 800;
                const currentScroll = carousel.scrollLeft;
                const newScroll = currentScroll + (scrollAmount * direction);
                
                carousel.scrollTo({
                    left: newScroll,
                    behavior: 'smooth'
                });
                
                console.log('Scrolling carousel:', carouselId, 'Direction:', direction);
            }

            document.addEventListener('DOMContentLoaded', function() {
                const buttons = document.querySelectorAll('[data-carousel]');
                buttons.forEach(button => {
                    button.addEventListener('click', function() {
                        const carouselId = this.getAttribute('data-carousel');
                        const direction = parseInt(this.getAttribute('data-direction'));
                        scrollCarousel(carouselId, direction);
                    });
                });
            });
        </script>
    </body>
</html>
