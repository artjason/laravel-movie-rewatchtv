@foreach ($movie['credits']['cast'] as $cast)
    @if ($cast['profile_path'] && $cast['character'])
        @if ($loop->index < 6)
            <div class="mt-8">
                <a href="{{route('actors.show', $cast['id'])}}" class="transition duration-150 ease-in-out hover:opacity-75"> <img class="w-full h-3/4 sm:h-full md:h-full lg:h-full xl:h-full"
                        src="{{ 'https://image.tmdb.org/t/p/w300/' . $cast['profile_path'] }}">
                </a>
                <div class="mt-2">
                    <a href="{{route('actors.show', $cast['id'])}}" class="mt-2 text-xs xl:text-lg sm:text-base hover:text-gray-300"> {{ $cast['name'] }} </a>
                    <div class="flex items-center mt-1 text-xs text-gray-400 sm:text-base xl:text-sm">
                        <span> as {{ $cast['character'] }} </span>
                    </div>
                </div>
            </div>
        @else
        @break
        @endif
    @endif
@endforeach
