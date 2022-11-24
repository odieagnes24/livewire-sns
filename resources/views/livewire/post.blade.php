<div class="@if($is_view) col-md-6 offset-3 @endif">    
    @if($is_view) <h2>Post</h2> @endif      
    <div class="card mb-4 shadow-sm">
        <div class="card-body">
            <div class="d-flex justify-content-between">
                <div>
                    <div class="d-flex justify-content-start align-items-center">
                        <img src="/assets/images/default.png" class="border border-3 rounded-circle" alt="default avatar" style="object-fit: contain;" width="50px" height="50px">
                        <div class="ms-1">
                            <a href="{{ route('view.user', ['user' => $post->user->uname]) }}" class="text-decoration-none">
                                <h6 class="card-title d-inline">  {{ $post->user->name }}</h6>
                            </a>
                            <br><small class="card-subtitle mb-2 text-muted">{{ $post->created_at->diffForHumans() }} · {{ $post->visibility }}</small> 
                        </div>
                    </div>
                </div>

                <div class="dropdown">
                    <button class="btn cust-btn" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-ellipsis-h"></i>
                    </button>
                    <ul class="dropdown-menu cust-btn-menu" aria-labelledby="dropdownMenuButton1">
                        @can('update', $post)
                            <li><span wire:click="setVisibility('Public')" class="dropdown-item @if($post->visibility == 'Public') text-success @endif">@if($post->visibility == 'Public') <i class="fas fa-check-circle"></i> @endif Public</span></li>
                            <li><span wire:click="setVisibility('Followers Only')"class="dropdown-item @if($post->visibility == 'Followers Only') text-success @endif">@if($post->visibility == 'Followers Only') <i class="fas fa-check-circle"></i> @endif Followers Only</span></li>
                            <li><span wire:click="setVisibility('Only Me')" class="dropdown-item @if($post->visibility == 'Only Me') text-success @endif">@if($post->visibility == 'Only Me') <i class="fas fa-check-circle"></i> @endif Only Me</span></li>
                            <li><hr class="dropdown-divider"></li>
                        @endcan

                        <li> 
                            <span class="dropdown-item">
                                <a href="{{ route('view.post', $post->id) }}" target="_blank" class="text-decoration-none"><i class="fas fa-external-link-alt"></i> Open in new tab</a>
                            </span>
                        </li>
                        @can('deletePost', $post)
                            <li><span class="dropdown-item" onclick="confirm('Are you sure you want to delete this post?') || event.stopImmediatePropagation()" wire:click="delete"><i class="far fa-trash-alt"></i> Delete</span></li>
                        @endcan
                        <li>
                            <span class="dropdown-item" wire:click="savePost">
                                @if(!empty($post->user_saved))
                                    <i class="fas fa-bookmark text-primary"></i> Saved
                                @else
                                    <i class="far fa-bookmark"></i> Save
                                @endif
                            </span>
                        </li>
                    </ul>
                </div>
               
            </div>
            <p class="card-text mt-2">{{ $post->contents }}</p>
            @if($post->media_type == 'photo')
                <img src="/photos/{{ $post->media_type_src }}" class="img-fluid" alt="Post Image">
            @elseif($post->media_type == 'youtube')
                <div class="ratio ratio-16x9" wire:ignore>
                    {!! $post->media_type_src !!}
                </div>
            @elseif($post->media_type == 'soundcloud')
                {!! $post->media_type_src !!}
            @endif
        </div>
        <div class="border-top px-3">
            <div class="d-flex justify-content-around py-2">
                <span class="custom_buttons" wire:click.prevent="up">@if(!empty($post->user_like)) @if($post->user_like->type == 'liked') <i class="fas fa-thumbs-up"></i> @else <i class="far fa-thumbs-up"></i> @endif @else <i class="far fa-thumbs-up"></i> @endif {{ $post->likes_count }}</span>
                <span class="custom_buttons" wire:click.prevent="down">@if(!empty($post->user_like)) @if($post->user_like->type == 'disliked') <i class="fas fa-thumbs-down"></i> @else <i class="far fa-thumbs-down"></i> @endif @else <i class="far fa-thumbs-down"></i> @endif {{ $post->dislikes_count }}</span>
                <span class="custom_buttons" wire:click.prefetch="fetchComments
                "><i class="far fa-comments"></i> {{ $post->comments_count }}</span>
            </div>
        </div>

        @if(!$showComments)
        <div wire:loading wire:target="fetchComments">
            <div class="border-top pt-3 pb-3 border d-flex justify-content-center"> 
                <div class="spinner-grow spinner-grow-sm" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>
        </div>
        @endif

        @if($showComments)
        <div class="border-top px-3 pt-3">
            @livewire('create-comment', ['post' => $post])

            @foreach($comments as $comment)
                @livewire('comment', ['comment' => $comment], key($comment->id))
            @endforeach

            @if($paginate_comments < $post->comments_count)
                <a href="#" class="mb-4" wire:click.prevent="loadMoreComments">Show More Comments</span>
            @endif
        </div>
        @endif
    </div>
</div>