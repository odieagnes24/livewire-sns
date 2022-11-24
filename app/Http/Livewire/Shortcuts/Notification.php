<?php

namespace App\Http\Livewire\Shortcuts;

use Livewire\Component;

class Notification extends Component
{
    public $notifications_count;
    public $is_mobile_view;

    protected $listeners = ['notif_refresh' => '$refresh'];

    public function mount($is_mobile_view = false)
    {
        $this->is_mobile_view = $is_mobile_view;
        $this->hydrate();
    }

    public function hydrate()
    {
        $this->notifications_count = auth()->user()->notifications()->where('is_read', '0')->count();
    }

    public function render()
    {
        return view('livewire.shortcuts.notification');
    }
}
