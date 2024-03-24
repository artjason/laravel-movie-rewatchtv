<?php

namespace Tests\Feature;
use Illuminate\Support\Facades\Http;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    public function testTheMainPageShowsCorrectInfo()
    {
       Http::fake([
       'https://api.themoviedb.org/3/movie/popular?page=1' => $this->fakePopularMovieResponse()
]);
        $response = $this->get(route('movies.index'));
        $response->assertSuccessful();
        $response->assertSee('Popular');

    }
    private function fakePopularMovieResponse(){
         Http::response([
        'results' => [
            [
                "adult" => false,
                "backdrop_path" => "/yl2GfeCaPoxChcGyM5p7vYp1CKS.jpg",
                "genre_ids" => [28, 35, 10749],
                "id" => 848187,
                "original_language" => "en",
                "original_title" => "Role Play",
                "overview" => "Emma has a wonderful husband and two kids in the suburbs of New Jersey – she also has a secret life as an assassin for hire – a secret that her husband David discovers when the couple decide to spice up their marriage with a little role play.",
                "popularity" => 501.304,
                "poster_path" => "/7MhXiTmTl16LwXNPbWCmqxj7UxH.jpg",
                "release_date" => "2024-01-04",
                "title" => "Role Play",
                "video" => false,
                "vote_average" => 6.034,
                "vote_count" => 369
            ],
            // Add more movie results here if needed
        ]
    ], 200);
    }
}
