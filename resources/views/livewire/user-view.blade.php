<div class="col offset-md-0 offset-lg-3">
    <div class="d-flex">
        <div class="">
            <img src="/assets/images/default.png" class="border border-4 rounded-circle" alt="default avatar" style="object-fit: contain;" width="170px" height="170px">
        </div>
        
        <div class="ms-3 d-flex align-items-center">
            <div>
                <h2 class="d-inline">{{ $user->name }}</h2>
                <br>
                <span>{{ $user->posts()->count() . ' '. Str::plural('Post', $user->posts()->count())}}</span> 
                <span style="font-size: smaller;">|</span>
                <span>{{ $followers_count . ' '. Str::plural('Follower', $followers_count)}}</span> 
                <span style="font-size: smaller;">|</span>
                <span>{{ $followings_count . ' '. Str::plural('Following', $followings_count)}}</span> 
            </div>
        </div>
    </div>
    
    <div class="row mt-5 ">
        <div class="col-md-8">
            @foreach($posts as $post)
                @livewire('post', ['post' => $post, 'is_view' => false], key($post->id))
            @endforeach
        </div>
    </div>

    @if($posts->count() != $all_count)
    <div class="col-md-8 d-grid gap-2">
        <button class="btn btn-primary mb-5" wire:click="loadPosts()">
            <span wire:target="loadPosts" wire:loading.class="d-none"> See More</span>
            <div class="spinner-grow spinner-grow-sm d-none" wire:target="loadPosts" wire:loading.class.remove="d-none" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </button>
    </div>
    @endif
</div>
