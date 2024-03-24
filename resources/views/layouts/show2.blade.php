@extends('main')
@section('content')
<div class="border-b border-gray-800 movie-info">
    <div class="container flex px-4 py-16 mx-auto">
        <img src="{{ 'https://image.tmdb.org/t/p/w500/' . $series['poster_path'] }}"
            class="ml-5 transition duration-150 ease-in-out hover:opacity-75 w-28 lg:w-96 sm:w-40 md:w-56">
        <div class="ml-4 lg:ml-24 sm:ml-6 md:ml-6">
            <h2 class="text-base font-semibold lg:text-2xl md:text-xl">{{ $series['name'] }}</h2>
            <div
                class="flex mt-2 text-xs text-gray-400 lg:text-base lg:items-center md:items-center md:text-sm md:flex-row">
                @include('icons.star')
                <span class="ml-1">{{ $series['vote_average']*10 . '%' }}</span>
                <span class="mx-2">|</span>
                <span>{{ \Carbon\Carbon::parse($series['first_air_date'])->format('M d, Y') }}</span>
                <span class="mx-2">|</span>
                <span>
                    @foreach ($series['genres'] as $genre)
                    {{ $genre['name'] }}
                    @if (!$loop->last)
                    , {{-- This is the last iteration --}}
                    @endif
                    @endforeach
                </span>
            </div>
            <div>
                <p class="justify-center mt-3 text-xs text-gray-400 lg:mt-5 lg:text-1xl md:mt-4 md:text-sm">
                    {{ $series['overview'] }}</p>
            </div>
            <div class="mt-5 lg:mt-12 md:mt-7">

                <h4 class="text-sm font-semibold text-white md:text-base lg:text-lg"> Featured Crew </h4>

                @if (count($series['credits']['crew']) > 0)
                <div class="flex mt-2 lg:mt-4">
                    @foreach ($series['credits']['crew'] as $crew)
                    @if ($loop->index < 2 ) <div class="mr-8">
                        <div class="text-xs md:text-sm lg:text-base">{{ $crew['name'] }} </div>
                        <div class="text-xs text-gray-400 md:text-sm lg:text-sm">
                            {{ $crew['job'] }}</div>
                </div>
                @endif

                @endforeach
            </div>
            @else
            <div class="text-xs text-yellow-500 md:text-sm lg:text-base">Nothing to show </div>
            @endif

        </div>
        @if (count($series['videos']['results']) > 0)
        <div class="mt-6 lg:mt-14 md:mt-10">
            <a href="https://youtube.com/watch?v={{$series['videos']['results'][0]['key']}}"
                class="inline-flex items-center px-4 py-3 text-xs font-semibold text-gray-900 transition duration-150 ease-in-out bg-orange-500 rounded lg:px-5 lg:py-4 hover:bg-orange-400">
                @include('icons.play') <span class="ml-2"> Play Trailer</span></a>
        </div>
        @endif
    </div>
</div>
</div>
<div class="border-b border-gray-800 movie-cast">
    <div class="container px-4 py-10 mx-auto">
        <h2 class="text-4xl font-semibold">Cast</h2>
    </div>
    <div class="container px-5 pt-1 mx-auto mb-24">
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6">
            @if (count($series['credits']['cast']) > 0)
            @include('layouts.seriescast')
            @else
            <div class="top-0 text-xs text-yellow-500 md:text-sm lg:text-base">Nothing to show </div>
            @endif
        </div>
    </div>
</div>
<div class="border-b border-gray-800">
    <div class="container px-4 py-12 mx-auto">
        <h2 class="text-4xl font-semibold">Posters</h2>
    </div>
    <div class="container px-5 pt-1 mx-auto">
        <div class="grid items-center grid-cols-1 gap-8 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3">
            @include('layouts.images')
        </div>
    </div>
</div>
@endsection
