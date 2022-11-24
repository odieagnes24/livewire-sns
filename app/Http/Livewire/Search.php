<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class Search extends Component
{
    public $results_users;
    public $results_posts;
    public $query;
    public $is_live_search = false;

    public function mount()
    {
        $this->results_users = collect([]);
        $this->query = request()->get('query');
    }

    public function liveSearch()
    {
        $this->is_live_search = true;
        $this->results_users = collect([]);
        if(strlen($this->query) > 2)
        {
            $users = User::select('id', 'name', 'uname', 'created_at')
                            ->where('name', 'like', '%' . $this->query . '%')
                            ->orWhere('uname', 'like', '%' . $this->query . '%')
                            ->get();

            $this->results_users = $users;
        }
    }

    public function doSearch()
    {
        return redirect()->route('search.view', ['query' => $this->query]);
        // return redirect()->to('search?query=');
    }

    public function render()
    {
        return view('livewire.search');
    }
}
