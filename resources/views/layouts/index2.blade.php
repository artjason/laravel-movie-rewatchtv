@extends('main')

@section('content')
<div class="container px-4 pt-16 mx-auto border-b border-gray-500">
    <div class="popular-movies">
        <h2 class="text-base font-semibold tracking-wider text-orange-500 uppercase xl:text-lg"> Popular </h2>
        <div class="grid grid-cols-2 gap-2 xl:gap-8 sm:gap-4 lg:gap-8 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 ">
            @include('layouts.popularactors')
        </div>
    </div>
</div>
@endsection
