@foreach ($popularMovies['results'] as $movie)
    <div class="mt-8 mb-8">
        <a href="{{ route('movies.show', $movie['id']) }}" class="transition duration-150 ease-in-out hover:opacity-75">
            <img src="{{ 'https://image.tmdb.org/t/p/w500/' . $movie['poster_path'] }}">
        </a>

        <div class="mt-2">
            <a href="{{ route('movies.show', $movie['id']) }}"
                class="mt-2 text-base lg:text-lg hover:text-gray-300">{{ $movie['title'] }}</a>

            <div class="flex items-center mt-1 text-sm text-gray-400">
                @include('icons.star')
                <span class="ml-1 text-sm">{{ $movie['vote_average'] * 10 . '%' }}</span>
                <span class="mx-2">|</span>
                <span class="text-sm">{{ \Carbon\Carbon::parse($movie['release_date'])->format('M d, Y') }}</span>
            </div>
            <div class="text-xs text-gray-400">
                @foreach ($movie['genre_ids'] as $genre)
                    {{ $genres->get($genre) }}
                    @if (!$loop->last)
                        , {{-- This is the last iteration --}}
                    @endif
                @endforeach
            </div>
        </div>
    </div>
@endforeach
