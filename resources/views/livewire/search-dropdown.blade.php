<div class="relative" x-data="{ openDropdown: true }" @click.away="openDropdown = false">
    <div class="absolute top-0 left-0 px-1">@include('icons.search')</div>
    <input @focus = "openDropdown = true" @keydown ="openDropdown = true" @keydown.escape.window="openDropdown = false"
        @keydown.shift.window ="openDropdown = false" wire:model.live="search" type="text"
        class="px-8 py-1 pl-10 text-sm bg-gray-800 rounded-full w-72 sm:w-60 focus:outline-none focus:shadow-outline"
        placeholder="Search (Press '/' to focus)" x-ref ="search"
        @keydown.window = "
           if(event.keyCode == 191){
            event.preventDefault();
             $refs.search.focus();
           }
        ">

    <span wire:loading
        class="absolute top-0 mr-2 mt-1 right-0 inline-block h-5 w-5 animate-spin rounded-full border-4 border-solid border-current border-r-transparent align-[-0.125em] motion-reduce:animate-[spin_1.5s_linear_infinite]"
        role="status">
    </span>


    @if (!empty($searchResults['results']))
        <div class="absolute z-50 items-center w-64 mt-2 text-sm bg-gray-800 rounded" x-show="openDropdown"
            x-transition:enter="transition ease-out transform" x-transition:leave="transition ease-in"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
            @if (count($searchResults['results']) > 0)
                <ul>
                    @foreach ($searchResults['results'] as $result)
                        @if ($loop->index < 8)
                            <li class="border-b border-gray-700"
                                @if ($loop->index == 7) @keydown.tab="openDropdown = false" @endif>
                                <a href="{{ route('movies.show', $result['id']) }}"
                                    class="flex items-center px-3 py-3 hover:bg-gray-500">
                                    @if ($result['poster_path'])
                                        <img src="{{ 'https://image.tmdb.org/t/p/w92/' . $result['poster_path'] }}"
                                            class="w-8">
                                    @else
                                        <span class="w-8"> @include('icons.defaultImage')</span>
                                    @endif
                                    <span class="ml-4">{{ $result['title'] }}</span>
                                </a>
                            </li>
                        @endif
                    @endforeach
                </ul>
            @else
                <div class="px-3 py-3">No results for "{{ $search }}"</div>
            @endif
        </div>
    @endif
</div>
