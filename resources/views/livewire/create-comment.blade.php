<div class="p-0">
    <form class="row p-0" wire:submit.prevent="create">
        <div class="col-1">
            <img src="/assets/images/default.png" class=" rounded-circle border border-3" style="width:30px;height:30px;">
        </div>
        <div class="col pr-0 pt-0 d-flex justify-content-between">
            <input type="text" wire:model="comments" class="form-control me-2 @error('comments') is-invalid @enderror" placeholder="Your comment">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-comment" wire:target="create" wire:loading.class="d-none"></i>
                <div class="spinner-grow spinner-grow-sm d-none" wire:target="create" wire:loading.class.remove="d-none" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </button>
        </div>
        <div class="row">
            <div class="col-1"></div>
            <div class="col">
                @error('comments') <div><small class="text-danger">{{ $message }}</small></div> @enderror
            </div>
        </div>

    </form>
</div>