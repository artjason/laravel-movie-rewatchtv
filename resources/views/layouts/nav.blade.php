 <nav class="border-b border-gray-800">
     <div class="container flex flex-col items-center justify-between px-4 py-6 mx-auto sm:px-1 md:flex-row">
         <ul class="flex flex-col items-center mt-2 text-xs sm:mt-1 md:flex-row md:mt-0">
             <li class="md:ml-16">
                 <a href="{{route('movies.index')}}">
                     @include('icons.logo')
                     <span class="font-extrabold text-blue-500"> RewatchTV </span>
                 </a>
             </li>
             <li class="mt-4 text-blue-500 rounded-sm sm:mx-1 md:ml-10 md:mt-0 hover:text-yellow-500">
                 <a href="{{route('movies.index')}}" class="{{Route::is('movies.index') || Route::is('movies.show') ? 'bg-yellow-500 text-blue-500 rounded px-2 py-1': ''}}"> Movies</a>
             </li>
             <li class="mt-2 text-blue-500 rounded-sm sm:ml-0 md:ml-6 md:m-0 hover:text-yellow-500">
                 <a href="{{route('series.index')}}" class="{{Route::is('series.index') || Route::is('series.show') ? 'bg-yellow-500 text-blue-500 rounded px-2 py-1': ''}}"> TV Series</a>
             </li>
             <li class="mt-2 text-blue-500 rounded-sm md:ml-6 md:m-0 hover:text-yellow-500">
                 <a href="{{route('actors.index')}}" class="{{Route::is('actors.index') || Route::is('actors.show') || Route::is('host.show') ? 'bg-yellow-500 text-blue-500 rounded px-2 py-1' : ''}}">Actors</a>
             </li>
         </ul>
         <div class="flex flex-col items-center mt-2 md:flex-row md:mt-0">
             @livewire('search-dropdown')
             <div class="mt-4 md:ml-6 md:mt-0">
                 <a href="#">
                     <img src= {{ asset('images/dp.jpg') }} alt="dp picture" class="w-8 h-8 rounded-full">
                 </a>
             </div>
         </div>
     </div>
 </nav>
