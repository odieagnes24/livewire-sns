<?php

namespace App\Http\Livewire;

use App\Events\PostCreated;
use Livewire\Component;
use Livewire\WithFileUploads;

class PostCreate extends Component
{
    use WithFileUploads;

    public $contents;
    public $photo;
    public $yt;
    public $soundcloud;
    public $iteration;
    public $media_type = 'photo';
    public $visibility = 'Public';

    public function render()
    {
        return view('livewire.post-create');
    }

    protected $rules = [
        'contents' => 'required|min:1',
        'photo' => 'nullable|image|max:1024'
    ];

    public function savePost()
    {  
        $validatedData = $this->validate();

        if($this->media_type == 'photo' && !empty($this->photo))
        {
            $this->photo->store('public/photos');
            $new_post = auth()->user()->posts()->create([
                            'contents' => $this->contents,
                            'media_type' => 'photo',
                            'media_type_src' => $this->photo->hashName(),
                            'visibility' => $this->visibility,
                        ]);
        }
        elseif($this->media_type == 'yt' && !empty($this->yt))
        {
            $new_post = auth()->user()->posts()->create([
                            'contents' => $this->contents,
                            'media_type' => 'youtube',
                            'media_type_src' => $this->yt,
                            'visibility' => $this->visibility,
                        ]);
        }
        elseif($this->media_type == 'soundcloud' && !empty($this->soundcloud))
        {
            $new_post = auth()->user()->posts()->create([
                            'contents' => $this->contents,
                            'media_type' => 'soundcloud',
                            'media_type_src' => $this->soundcloud,
                            'visibility' => $this->visibility,
                        ]);
        }
        else
        {
            $new_post = auth()->user()->posts()->create([
                            'contents' => $this->contents,
                            'visibility' => $this->visibility,
                        ]);
        }

        $this->reset(['contents', 'photo', 'yt', 'soundcloud', 'visibility']);
        $this->iteration++;
        session()->flash('message', 'Post successfully created!');

        // $this->emit('postCreated', $new_post->id);
        broadcast(new PostCreated())->toOthers();
        $this->dispatchBrowserEvent('post-created', ['contents' => 'Post successfully created!']);
    }
}
