<?php

namespace App\ViewModels;

use Spatie\ViewModels\ViewModel;
use App\ViewModels\Carbon;

class MoviesViewModel extends ViewModel
{
    public $popularMovies, $nowplayingMovies, $genres;
    public function __construct($popularMovies, $nowplayingMovies, $genres)
    {
        $this->popularMovies = $popularMovies;
        $this->nowplayingMovies = $nowplayingMovies;
        $this->genres = $genres;
    }
    //construct is working
    public function popularMoviesData()
    {
        // return collect($this->popularMovies)->map(function ($movie) {
        //     return collect($movie)->merge([
        //         'poster_path' => isset($movie['poster_path']) ? 'https://image.tmdb.org/t/p/w500/' . $movie['poster_path'] : null,
        //         'vote_average' => isset($movie[' vote_average']) ? $movie['vote_average'] * 10 . '%' : null,
        //         'released_date' => isset($movie['release_date']) ? \Carbon\Carbon::parse($movie['release_date'])->format('M d, Y') : null,
        //     ]);
        // });
    //      return [
    //     'popularMovies' => $this->popularMovies,
    //     'nowplayingMovies' => $this->nowplayingMovies,
    //     'genres' => $this->genres,
    // ];
    }

    public function nowplayingMovies()
    {
        return $this->nowplayingMovies;
    }
    public function genres()
    {
        return $this->genres;
    }
}
