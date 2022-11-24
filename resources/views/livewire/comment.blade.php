<div class="d-flex mb-3">
    <img src="/assets/images/default.png" alt="{{ $comment->user->name }}" class="flex-shrink-0 me-3 rounded-circle border border-4" style="width:30px;height:30px;">
    <div>
        <h6>{{ $comment->user->name }} · <small class="text-secondary">{{ $comment->created_at->diffForHumans() }}</small></h6>
        <div>
            {{ $comment->contents }}
        </div>
        <div> 
            <small class="custom_buttons" wire:click.prevent="up">@if(!empty($comment->user_like)) @if($comment->user_like->type == 'liked') <i class="fas fa-thumbs-up"></i> @else <i class="far fa-thumbs-up"></i> @endif @else <i class="far fa-thumbs-up"></i> @endif {{ $comment->likes_count }}</small> ·
            <small class="custom_buttons" wire:click.prevent="down">@if(!empty($comment->user_like)) @if($comment->user_like->type == 'disliked') <i class="fas fa-thumbs-down"></i> @else <i class="far fa-thumbs-down"></i> @endif @else <i class="far fa-thumbs-down"></i> @endif {{ $comment->dislikes_count }}</small>
        </div>
    </div>
</div>