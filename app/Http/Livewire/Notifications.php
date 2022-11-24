<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Models\UserNotification;
use Livewire\Component;

class Notifications extends Component
{
    public $notifications;
    public $is_mobile_view;

    public function mount()
    {
        $this->notifications = auth()->user()->notifications()->orderByDesc('created_at')->get();
    }
    
    public function open(UserNotification $notification)
    {
        if($notification->is_read == 0)
        {
            $notification->is_read = 1;
            $notification->save();
        }
        
        if($notification->type == "post_like")
        {
            return redirect()->route('view.post', ['post' => $notification->optional_id]); 
        }
        elseif($notification->type == "user_follow")
        {
            $get_user = User::find($notification->optional_id);
            return redirect()->route('view.user', ['user' => $get_user->uname]); 
        }
    }
    
    public function render()
    {
        return view('livewire.notifications');
    }
}
