<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    @extends('navigation.app')
    <h2 class="text-xl font-bold mb-4">Lista de Juegos</h2>
    <ul>
        @foreach ($mangas as $manga)
            <li class="mb-2 p-2 bg-gray-700 rounded">{{ $manga->title }}</li>
        @endforeach
    </ul>
</body>
</html>