<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Pagination extends Component
{
    public $page = 1; // Current page
    public $maxPage = 500; // Maximum page

    public function previousPage()
    {
        if ($this->page > 1) {
            $this->page--;
        }
    }

    public function nextPage()
    {
        if ($this->page < $this->maxPage) {
            $this->page++;
        }
    }

    public function incrementPage()
    {
        $this->page++;
    }

   public function render()
    {
        $previous = max(1, $this->page - 1);
        $next = min($this->maxPage, $this->page + 1);

        return view('livewire.pagination', [
            'maxPage' => $this->maxPage,
            'previous' => $previous,
            'next' => $next,
        ]);
    }
}
