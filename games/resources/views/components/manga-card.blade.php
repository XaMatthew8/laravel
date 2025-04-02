@props(['manga'])

<a href="{{ route('mangas.show', $manga) }}" class="inline-block w-[160px]">
    <article class="h-[280px] bg-gray-800 rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300 flex flex-col">
        <div class="relative h-[200px]">
            <img 
                src="{{ $manga->imagen_portada }}" 
                alt="{{ $manga->titulo }}" 
                class="w-full h-full object-cover"
                onerror="this.src='https://placehold.co/160x200/1F2937/FFFFFF/png?text=No+Image'"
            >
            <div class="absolute top-0 right-0 bg-blue-600 text-white px-2 py-1 text-xs rounded-bl">
                {{ $manga->type }}
            </div>
            <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black to-transparent p-2">
                <div class="flex items-center">
                    <div class="text-yellow-400 text-xs">
                        <i class="fas fa-star"></i>
                    </div>
                    <span class="text-white ml-1 text-xs">{{ number_format($manga->rating, 2) }}</span>
                </div>
            </div>
        </div>
        <div class="p-2 flex-1 flex flex-col justify-between bg-gray-800">
            <h3 class="font-semibold text-sm mb-1 truncate text-gray-100">{{ $manga->titulo }}</h3>
            <div class="flex justify-between items-center">
                <span class="bg-orange-500 text-white px-2 py-0.5 rounded-full text-xs truncate max-w-full">
                    {{ $manga->category }}
                </span>
            </div>
        </div>
    </article>
</a> 
