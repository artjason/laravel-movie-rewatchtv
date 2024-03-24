@foreach ($movie['images']['backdrops'] as $backdrop)
    <div>

        <div x-data="{ openMovie: false, image: '' }">
            @if ($loop->index < 10 && $backdrop['file_path'])
                <a @click.prevent="
            openMovie = true
            image = '{{ 'https://image.tmdb.org/t/p/original/' . $backdrop['file_path'] }}'
            "
                    href="#" class="transition duration-150 ease-in-out hover:opacity-75"> <img
                        src="{{ 'https://image.tmdb.org/t/p/w500/' . $backdrop['file_path'] }}">
                </a>
                @else
                @break
        @endif
        <div x-show="openMovie" x-transition:enter="transition ease-out transform" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in transform"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
            class="fixed top-0 left-0 flex items-center w-full h-full overflow-y-auto shadow-lg">
            <div class="container mx-auto overflow-y-auto rounded-lg lg:px-32">
                <div class="rounded bg-zinc-800">
                    <div class="flex justify-end pt-2 pr-4">
                        <button @click="openMovie = false"
                        @keydown.escape.window ="openMovie = false"
                            class="text-3xl leading-none hover:text-gray-300">&times;</button>
                    </div>
                    <div class="px-8 py-8 modal-body">
                        {{-- Content of the modal --}}
                       <img :src="image" alt="image">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach
