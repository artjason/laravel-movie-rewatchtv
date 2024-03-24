@foreach ($onAirSeries['results'] as $series)
    <div class="mt-8 mb-8">
        <a href="{{ route('series.show', $series['id']) }}" class="transition duration-150 ease-in-out hover:opacity-75">
            <img src="{{ 'https://image.tmdb.org/t/p/w500/' . $series['poster_path'] }}">
        </a>
        <div class="mt-2">
            <a href="{{ route('series.show', $series['id']) }}" class="mt-2 text-sm lg:text-lg hover:text-gray-300">
                {{ $series['name'] }} </a>
            <div class="flex items-center mt-1 text-sm text-gray-400">
                @include('icons.star')
                <span class="ml-1">{{ $series['vote_average'] * 10 . '%' }}</span>
                <span class="mx-2">|</span>
                <span class="text-sm"> {{ \Carbon\Carbon::parse($series['first_air_date'])->format('M d, Y') }}</span>
            </div>
            <div class="text-sm text-gray-400">
                @foreach ($series['genre_ids'] as $genre)
                    {{ $genres->get($genre) }}
                    @if (!$loop->last)
                        , {{-- This is the last iteration --}}
                    @endif
                @endforeach
            </div>
        </div>
    </div>
@endforeach
