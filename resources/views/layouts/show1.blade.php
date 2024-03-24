@extends('main')
@section('content')
    <div class="border-b border-gray-800 movie-info">
        <div class="container flex px-4 py-16 mx-auto">
            <img src="{{ 'https://image.tmdb.org/t/p/w500/' . $series['poster_path'] }}"
                class="ml-5 w-28 lg:w-96 sm:w-40 md:w-56">
            <div class="ml-4 lg:ml-24 sm:ml-6 md:ml-6">
                <h2 class="text-base font-semibold lg:text-2xl md:text-xl">{{ $series['name'] }}</h2>
                <div
                    class="flex mt-2 text-xs text-gray-400 lg:text-base lg:items-center md:items-center md:text-sm md:flex-row">
                    @include('icons.star')
                    <span class="ml-1">{{ $series['vote_average']*10 .'%' }}</span>
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
                                @if ($loop->index < 2)
                                    <div class="mr-8">
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
                <div x-data="{ openSeries: false }">
                    <div class="mt-6 lg:mt-14 md:mt-10">
                        @if (count($series['videos']['results']) > 0)
                            <button @click="openSeries = true"
                                class="inline-flex items-center px-4 py-3 text-xs font-semibold text-gray-900 transition duration-150 ease-in-out bg-orange-500 rounded lg:px-5 lg:py-4 hover:bg-orange-400">
                                @include('icons.play') <span class="ml-2"> Play Trailer</span></button>
                            </button>
                        @endif
                    </div>

                    <div x-show="openSeries" x-transition:enter="transition ease-out transform"
                        x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                        x-transition:leave="transition ease-in transform" x-transition:leave-start="opacity-100"
                        x-transition:leave-end="opacity-0"
                        class="fixed top-0 left-0 z-50 flex items-center w-full h-full overflow-y-auto shadow-lg">
                        <div class="container mx-auto overflow-y-auto rounded-lg lg:px-32">
                            <div class="rounded bg-zinc-800">
                                <div class="flex justify-end pt-2 pr-4">
                                    <button @click="openSeries = false" @keydown.escape.window="openSeries = false"
                                        class="text-3xl leading-none hover:text-gray-300">&times;</button>
                                </div>
                                <div class="px-8 py-8 modal-body">
                                    {{-- Content of the modal --}}
                                    @if (count($series['videos']['results']) > 0)
                                        <div class="relative overflow-hidden responsive-container"
                                            style="padding-top: 56.25%">
                                            <iframe class="absolute top-0 left-0 z-50 w-full h-full responsive-iframe"
                                                src="https://www.youtube.com/embed/{{ $series['videos']['results'][0]['key'] }}"
                                                style="border:0;" allow="autoplay; encrypted-media"
                                                allowfullscreen></iframe>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <div class="border-b border-gray-800 movie-cast">
        <div class="container px-4 py-10 mx-auto">
            <h2 class="text-base font-semibold sm:text-2xl md:text-3xl lg:text-4xl xl:text-4xl">Cast</h2>
        </div>
        <div class="container px-5 pt-1 mx-auto mb-24">
            <div
                class="grid grid-cols-2 gap-2 sm:gap-4 md:gap-4 lg:gap-4 xl:gap-4 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6">
                @if (count($series['credits']['cast']) > 0)
                    @include('layouts.seriescast')
                @else
                    <div class="top-0 text-xs text-yellow-500 md:text-sm lg:text-base">Nothing to show </div>
                @endif
            </div>
        </div>
    </div>
    <div class="border-b border-gray-800">
        <div class="container px-4 py-10 mx-auto">
            <h2 class="text-base font-semibold sm:text-2xl md:text-3xl lg:text-4xl xl:text-4xl">Posters</h2>
        </div>
        <div class="container px-5 pt-1 mx-auto">
            <div
                class="grid items-center grid-cols-2 gap-2 sm:gap-4 md:gap-4 lg:gap-6 xl:gap-8 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3">
                @if (count($series['images']['backdrops']) > 0)
                    @include('layouts.images')
                @else
                    <div class="top-0 mb-20 text-xs text-yellow-500 md:text-sm lg:text-base">Nothing to show </div>
                @endif
            </div>
        </div>
    </div>
    <div class="border-b border-gray-800">
        <div class="container px-4 py-12 mx-auto">
            <h2 class="text-base font-semibold sm:text-2xl md:text-3xl lg:text-4xl xl:text-4xl">Reviews</h2>
        </div>
        <div class="container px-4 py-20 mx-auto mt-5 mb-24">
            @if(count($series['reviews']['results']) > 0)
                @foreach ($series['reviews']['results'] as $review)
                    <div class="px-4 text-1xl"> {{ $review['author'] }} <span class="float-right text-sm text-slate-400">
                            {{ $review['created_at'] }} </span></div>
                    <span class="px-4 text-sm text-slate-400"> {{ $review['author_details']['username'] }}</span>
                    <div class="flex px-4 py-2">
                        <span class="py-1"> @include('icons.star') </span>
                        <span class="ml-1 text-sm">{{ $review['author_details']['rating'] . '/10' }} </span>
                    </div>
                    <div class="px-4 py-4 mt-1 mb-8 text-xs italic text-justify text-blue-500"> {{ $review['content'] }} </div>
                @endforeach
            @else
                <div class="text-xs text-yellow-500 md:text-sm lg:text-base">Nothing to show </div>
            @endif
        </div>
    </div>
@endsection
