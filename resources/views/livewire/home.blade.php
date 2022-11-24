<div class="col-md-6 offset-md-0 offset-lg-3">
    <div class="d-flex justify-content-between align-items-center">
        <h2>Feed</h2>
        @if(Route::current()->getName() == 'feed')
            <span><i class="fas fa-fire"></i> Hot</span>
        @elseif(Route::current()->getName() == 'top')
            <span><i class="fas fa-chart-bar"></i> Top</span>
        @elseif(Route::current()->getName() == 'fresh')
            <span><i class="far fa-clock"></i> Fresh</span>
        @elseif(Route::current()->getName() == 'random')
            <span><i class="fas fa-dice"></i> Random</span>
        @endif
    </div>

    

    @foreach($posts as $post)
        @livewire('post', ['post' => $post, 'is_view' => false], key($post->id))
    @endforeach

    @if($posts->count() != $all_count)
    <div class="d-grid gap-2">
        <button class="btn btn-primary mb-5" wire:click="loadPosts()">
            <span wire:target="loadPosts" wire:loading.class="d-none"> See More</span>
            <div class="spinner-grow spinner-grow-sm d-none" wire:target="loadPosts" wire:loading.class.remove="d-none" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </button>
    </div>
    @endif
</div>
 