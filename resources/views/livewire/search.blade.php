<div class="w-50 position-relative d-none d-lg-block">
    <form class="d-flex mb-0" wire:submit.prevent="doSearch">
        <input class="form-control rounded-0 rounded-start" type="text" name="query" placeholder="Search" wire:model="query" wire:keydown="liveSearch" autocomplete="off">
        <button class="btn btn-secondary rounded-0 rounded-end" type="submit"><i class="fas fa-search"></i></button>
    </form>

    @if(strlen($query) > 2 && $is_live_search)
    <div class="bg-white p-2 w-100 rounded shadow position-absolute">
        @if(!$results_users->isEmpty())
            @foreach($results_users as $user)
                <a href="{{ route('view.user', $user->uname) }}" class="text-decoration-none">
                    <div class="d-flex align-items-center py-1">
                        <img src="/assets/images/default.png" class="border border-3 rounded-circle" alt="default avatar" style="object-fit: contain;" width="30px" height="30px">
                        <span class="ms-2">{{ $user->name }}</span>
                    </div>
                </a>
            @endforeach
        
        @else
            <div class="d-flex justify-cotent-center">
                <h6><i>No results found</i></h6>
            </div>
        @endif
    </div>
    @endif
</div>


