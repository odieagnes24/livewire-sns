<div class="container">
    <div class="row">
        <div class="col-6">
            <h2>Feed</h2>
            @livewire('post-create')
            <div wire:poll.10000ms>
          
                @foreach($posts as $post)
                    <div class="card mb-4">
                        <div class="card-body">
                            <h4 class="card-title">{{ $post->user->name }}</h4>
                            <h6 class="card-subtitle mb-2 text-muted">{{ $post->created_at->diffForHumans() }}</h6>
                            <p class="card-text">{{ $post->contents }}</p>
                        </div>
                        <div class="border-top px-3">
                            <div class="d-flex justify-content-around py-2">
                                <span class="custom_buttons" wire:click.prevent="up({{ $post }})">@if(!empty($post->user_like)) @if($post->user_like->type == 'liked') <i class="fas fa-thumbs-up"></i> @else <i class="far fa-thumbs-up"></i> @endif @else <i class="far fa-thumbs-up"></i> @endif {{ $post->likes_count }}</span>
                                <span class="custom_buttons" wire:click.prevent="down({{ $post }})">@if(!empty($post->user_like)) @if($post->user_like->type == 'disliked') <i class="fas fa-thumbs-down"></i> @else <i class="far fa-thumbs-down"></i> @endif @else <i class="far fa-thumbs-down"></i> @endif {{ $post->dislikes_count }}</span>
                                <span class="custom_buttons"><i class="far fa-comments"></i> 0</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            {{ $posts->links() }}
        </div>
    </div>
</div>

