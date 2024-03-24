<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SeriesController extends Controller
{
    public function index()
    {
        $curlHandles = [];
        $curlUrl =['https://api.themoviedb.org/3/tv/on_the_air',
        'https://api.themoviedb.org/3/tv/popular?page=1',
        'https://api.themoviedb.org/3/genre/tv/list'

    ];
        $dataRequests = [];
       for($i = 0 ; $i < count($curlUrl); $i++) {
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
            $err = curl_error($curlHandles[$i]);
            curl_close($curlHandles[$i]);
            if ($err) {
                echo "cURL Error #:". $err;
            }
            $dataRequests[$i] = json_decode($dataRequests[$i], true);
       }
        $popularSeries =$dataRequests[1];
        $onAirSeries = $dataRequests[0];
        $genreList = $dataRequests[2];

        $genres = collect($genreList['genres'])->mapWithKeys(function ($genre) {
                return [$genre['id'] => $genre['name']];
            });
        return view('layouts.index1',[
             'popularSeries' => $popularSeries,
             'genres' => $genres,
             'onAirSeries' => $onAirSeries,
        ]);

    }
    public function show( $id)
    {
        $curlHandles = [];
        $curlUrl = ['https://api.themoviedb.org/3/tv/'.$id.'?append_to_response=credits,videos,images,reviews',
        'https://api.themoviedb.org/3/person/'.$id.'/tv_credits'
];
        $dataRequests = [];
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
        $series = $dataRequests[0];
        $cast = $dataRequests[1];
    //    dd($series);

         return view('layouts.show1', compact('series' , 'cast'));
    }
}
