@foreach ($popularActors['results'] as $actor)
    <div class="mt-8 mb-8">
        <a href="{{route('actors.show', $actor['id'])}}" class="transition duration-150 ease-in-out hover:opacity-75">
            <img src="{{ 'https://image.tmdb.org/t/p/w500/' . $actor['profile_path'] }}">
        </a>
        <div class="mt-2">
            <a href="{{route('actors.show', $actor['id'])}}" class="mt-2 text-lg hover:text-gray-300"> {{ $actor['name'] }}
            </a>
            <div class="flex items-center mt-1 text-sm text-gray-400">
                @include('icons.star')
                <span class="ml-1">{{ round($actor['popularity'] * .10, 2) .'%' }}</span>
            </div>
            <div class="text-sm text-gray-400">
                @foreach ($actor['known_for'] as $known)
                    @if ($known['media_type'] == 'movie')
                        {{$known['title']}}
                    @elseif ($known['media_type'] == 'tv')
                        {{$known['name']}}
                    @endif
                    @if (!$loop->last),
                    @endif
                @endforeach
            </div>
        </div>
    </div>
@endforeach

