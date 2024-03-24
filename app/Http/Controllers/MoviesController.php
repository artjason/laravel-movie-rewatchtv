<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\ViewModels\MoviesViewModel;
class MoviesController extends Controller
{
    public function index()
    {
        $curlHandles = [];
        $dataRequests = [];
        $curlError = [];
        $curlUrl = ['https://api.themoviedb.org/3/movie/popular?page=1', 'https://api.themoviedb.org/3/genre/movie/list', 'https://api.themoviedb.org/3/movie/now_playing'];

        for ($i = 0; $i < count($curlUrl); $i++) {
            $curlHandles[$i] = curl_init();
            curl_setopt_array($curlHandles[$i], [
                CURLOPT_URL => $curlUrl[$i],
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
                CURLOPT_HTTPHEADER => ['Authorization: Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiJiYWNlOTU0OGZmNGUxOTYwMWU4NDIwODgzZjgzMGE4NiIsInN1YiI6IjY1ZDVmOTFmYzhhNWFjMDE3YmUxZjRlNyIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.hdNdtET04lOQSWkfYTHEXSg0OYklTV3jSFzOuev7pwc', 'accept: application/json'],
            ]);
            $dataRequest[$i] = curl_exec($curlHandles[$i]);
            $curlError[$i] = curl_error($curlHandles[$i]);
            if ($curlError[$i]) {
                return 'cURL Error #:' . $curlError[$i];
            }
            $dataRequests[$i] = json_decode($dataRequest[$i], true);
            curl_close($curlHandles[$i]);
        }

        $nowplayingMovies = $dataRequests[2];
        $popularMovies = $dataRequests[0];
        $genreList = $dataRequests[1];
        $genres = collect($genreList['genres'])->mapWithKeys(function ($genre) {
            return [$genre['id'] => $genre['name']];
        });
        return view('layouts.index', compact('popularMovies', 'nowplayingMovies', 'genres'));
    }
    public function show($id)
    {
        $curlHandles = [];
        $curlUrl = ['https://api.themoviedb.org/3/movie/' . $id . '?append_to_response=credits,videos,images,reviews'];
        $dataRequests = [];
        $curlError = [];

        for ($i = 0; $i < count($curlUrl); $i++) {
            $curlHandles[$i] = curl_init();
            curl_setopt_array($curlHandles[$i], [
                CURLOPT_URL => $curlUrl[$i],
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
                CURLOPT_HTTPHEADER => ['Authorization: Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiJiYWNlOTU0OGZmNGUxOTYwMWU4NDIwODgzZjgzMGE4NiIsInN1YiI6IjY1ZDVmOTFmYzhhNWFjMDE3YmUxZjRlNyIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.hdNdtET04lOQSWkfYTHEXSg0OYklTV3jSFzOuev7pwc', 'accept: application/json'],
            ]);
            $dataRequests[$i] = curl_exec($curlHandles[$i]);
            $curlError[$i] = curl_error($curlHandles[$i]);
            if ($curlError[$i]) {
                return 'cURL Error #:' . $curlError[$i];
            }
            $dataRequests[$i] = json_decode($dataRequests[$i], true);
        }
        $movies = $dataRequests[0];
        // dd($movies);
        return view('layouts.show', [
            'movie' => $movies,
        ]);
    }

}
