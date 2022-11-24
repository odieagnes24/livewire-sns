<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Models\UserPost;
use Livewire\Component;

class SearchPage extends Component
{
    public $results_users;
    public $results_posts;
    public $query;


    protected $queryString = ['query'];

    public function mount()
    {
        $this->results_users = collect([]);
        $this->results_posts = collect([]);

        if(empty(request()->get('query')))
        {
            abort(404);
        }

        if(strlen($this->query) > 2)
        {
            
            $users = User::select('id', 'name', 'uname', 'created_at')
                            ->where('name', 'like', '%' . $this->query . '%')
                            ->orWhere('uname', 'like', '%' . $this->query . '%')
                            // ->with(['auth_user_followed'])
                            ->get();
            
            $posts = UserPost::select('id', 'user_id', 'contents', 'created_at')
                            ->where('contents', 'like', '%' . $this->query . '%')
                            ->with(['user_like', 'user', 'user_saved'])
                            ->withCount(['likes', 'dislikes', 'comments'])
                            ->latest()
                            ->get();

            $this->results_users = $users;
            $this->results_posts = $posts;
            // dd($this->results_posts);
        }
        else
        {
            session()->flash('search_message', 'Query must be more than two characters!');
        }
    }

    public function render()
    {
        return view('livewire.search-page');
    }
}
