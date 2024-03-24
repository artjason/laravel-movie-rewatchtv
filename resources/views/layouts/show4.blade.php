@extends('main')
@section('content')
    <div class="border-b border-gray-800 movie-info">
        <div class="container flex px-4 py-16 mx-auto">
            <img src="{{ 'https://image.tmdb.org/t/p/w500/' . $host['profile_path'] }}"
                class="ml-5 w-28 lg:w-96 lg:h-full sm:w-40 md:w-56 ">
            <div class="ml-4 lg:ml-24 sm:ml-6 md:ml-6">
                <h2 class="text-base font-semibold lg:text-2xl md:text-xl">{{ $host['name'] }}
                </h2>
                @if($host['place_of_birth'])
                <div class="py-1 text-sm text-yellow-500">{{ 'Also known as ' . $host['place_of_birth'][0] }}</div>
                @endif
                <div
                    class="flex mt-2 text-xs text-gray-400 lg:text-base lg:items-center md:items-center md:text-sm md:flex-row">
                    @include('icons.star')
                    <span class="ml-1">{{ round($host['popularity'] * 0.1, 2) . '%' }}</span>
                    <span class="mx-2">|</span>
                    <span>{{ \Carbon\Carbon::parse($host['birthday'])->format('M d, Y') }}</span>
                    <span class="mx-2">|</span>
                    <span>{{ $host['place_of_birth'] }}</span>

                </div>
                <div>
                    <p class="mt-3 text-xs text-justify text-gray-400 lg:mt-5 lg:text-1xl md:mt-4 md:text-sm">
                        {{ $host['biography'] }}</p>
                </div>
                <div class="mt-5 lg:mt-12 md:mt-7">

                    <h4 class="text-sm font-semibold text-white md:text-base lg:text-lg"> Featured Projects </h4>

                    <div class="container flex gap-5 px-4 py-4 lg:mt-4">

                        @foreach ($host['tv_credits']['cast'] as $pr)
                            @if ($pr['backdrop_path'] && $loop->index < 5)
                                <div>
                                    <a href="{{ route('movies.show', $pr['id']) }}"> <img
                                            class="transition duration-150 ease-in-out rounded-md hover:opacity-75"
                                            src="{{ 'https://image.tmdb.org/t/p/w154/' . $pr['backdrop_path'] }}"> </a>
                                    <div
                                        class="mt-2 text-xs text-center text-gray-400 transition duration-150 ease-in-out rounded-md hover:opacity-75">
                                        <a href="{{ route('movies.show', $pr['id']) }}">{{ $pr['name'] }} </a></div>

                                </div>
                            @endif
                        @endforeach
                    </div>

                </div>

            </div>

        </div>
    </div>

    @if(count($host['tv_credits']) > 0)
    <div class="border-b border-gray-800 actor-credentials">
        <div class="container px-4 py-5 mx-auto">
            <h2 class="text-base font-semibold tracking-wider text-orange-500 uppercase xl:text-lg"> TV Credits </h2>
            <div class="mx-auto mt-5 ">

                <ul class="container grid grid-cols-3 mx-auto">
                    @foreach ($host['tv_credits']['cast'] as $cast)
                    <li class="py-1"><a href="{{route('series.show', $cast['id'])}}"
                            class="text-xs hover:text-blue-500">{{$cast['name']}} </a></li>
                    @endforeach

                </ul>
            </div>

        </div>
    </div>
    @endif
    @if(count($host['movie_credits']) > 0)
        <div class="container px-4 py-5 mx-auto border-b border-gray-800 ">
            <h2 class="text-base font-semibold tracking-wider text-orange-500 uppercase xl:text-lg"> Movie Credits </h2>
            <div class="mx-auto mt-5 ">

                <ul class="container grid grid-cols-3 mx-auto">
                    @foreach ($host['movie_credits']['cast'] as $cast)
                    <li class="py-1"><a href="{{route('movies.show', $cast['id'])}}"
                            class="text-xs hover:text-blue-500">{{$cast['title']}} </a></li>
                    @endforeach

                </ul>
            </div>
        </div>
    </div>
    @endif

@endsection
