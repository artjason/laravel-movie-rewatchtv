<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ActorsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clientUrl = curl_init();
        curl_setopt_array($clientUrl, [
            CURLOPT_URL => 'https://api.themoviedb.org/3/person/popular?page=1',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => ['Authorization: Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiJiYWNlOTU0OGZmNGUxOTYwMWU4NDIwODgzZjgzMGE4NiIsInN1YiI6IjY1ZDVmOTFmYzhhNWFjMDE3YmUxZjRlNyIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.hdNdtET04lOQSWkfYTHEXSg0OYklTV3jSFzOuev7pwc', 'accept: application/json'],
        ]);
        $response = curl_exec($clientUrl);
        curl_close($clientUrl);
        $popularActors = json_decode($response, true);
        // dd($popularActors);
        return view('layouts.index2', compact('popularActors'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */

    /**
     * Show the form for editing the specified resource.
     */
    public function show($id)
    {
        $curlHandles = [];
        $curlUrl = ['https://api.themoviedb.org/3/person/' . $id. '?append_to_response=movie_credits,tv_credits'];
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
        $actor = $dataRequests[0];
    //    dd($actor);

        // dd($reviews);
        return view('layouts.show3', compact('actor'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
