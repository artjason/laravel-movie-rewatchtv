<?php

namespace App\Livewire;

use Livewire\Component;

class SearchDropdown extends Component
{
    public $search = '';
    public function render()
    {
        $searchResults = [];
        if (strlen($this->search) >= 2) {
            $curl = curl_init();
            curl_setopt_array($curl, [
                CURLOPT_URL => 'https://api.themoviedb.org/3/search/movie?query=' . $this->search,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
                CURLOPT_HTTPHEADER => ['Authorization: Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiJiYWNlOTU0OGZmNGUxOTYwMWU4NDIwODgzZjgzMGE4NiIsInN1YiI6IjY1ZDVmOTFmYzhhNWFjMDE3YmUxZjRlNyIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.hdNdtET04lOQSWkfYTHEXSg0OYklTV3jSFzOuev7pwc', 'accept: application/json'],
            ]);
            $response = curl_exec($curl);
            curl_close($curl);
            $searchResults = json_decode($response, true);

        }
        return view('livewire.search-dropdown', [
            'searchResults' =>   $searchResults,
        ]);
    }
}
