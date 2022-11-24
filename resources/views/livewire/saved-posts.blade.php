<div class="col-md-6 offset-md-0 offset-lg-3">
    <h2>Saved</h2>

    @foreach($posts as $post)
        @livewire('post', ['post' => $post->post, 'is_view' => false], key($post->post->id))
    @endforeach
    
    @if($posts->isEmpty())
        <h3 class="mt-5 text-center"><i>Nothing to see here...</i></h3>
    @endif
    
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
 