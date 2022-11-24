<div class="d-flex justify-content-between align-items-center shadow bg-white p-3 rounded">
    <div class="w-100 d-flex align-items-center">
        <div>
            <img src="/assets/images/default.png" class="border border-3 rounded-circle" alt="default avatar" style="object-fit: contain;" width="50px" height="50px">
        </div>
        <div class="ms-1">
            <div class="d-flex align-items-center">
                <a href="{{ route('view.user', ['user' => $user->uname]) }}" class="text-decoration-none">
                    <span>{{ $user->name }}</span> 
                </a>    
                <span class="ms-1 text-muted" style="font-size: 12px;">@ {{ $user->uname }}</span> 
            </div>
            <div class="text-muted"  style="font-size: smaller;">
                <span>{{ $user->posts_count. ' '. Str::plural('Post', $user->posts_count)}}</span> 
                <span>|</span>
                <span>{{ $user->followers_count. ' '. Str::plural('Follower', $user->followers_count)}}</span> 
                <span>|</span>
                <span>{{ $user->followings_count. ' '. Str::plural('Following', $user->followings_count)}}</span> 
            </div>
        </div>
    </div>
    
    @if(auth()->user()->id !== $user->id)
    <div>
        <button class="btn btn-block btn-secondary btn-sm p-1 d-none" wire:target="followUser" wire:loading.class.remove="d-none">
            <div class="spinner-grow spinner-grow-sm" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </button>
        @if($user->auth_user_followed->isEmpty())
            <button class="btn btn-block btn-info btn-sm p-1" wire:click="followUser" wire:target="followUser" wire:loading.class="d-none"><i class="fas fa-user-plus"></i></button>
        @else
            <button class="btn btn-block btn-danger btn-sm p-1" wire:click="followUser" wire:target="followUser" wire:loading.class="d-none"><i class="fas fa-user-minus"></i></button>
        @endif  
    </div>
    @endif
</div>