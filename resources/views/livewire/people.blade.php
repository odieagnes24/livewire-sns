<div class="col d-none d-lg-block" style="max-height: 80vh; position: sticky; top: 118px;">
    <div class="border rounded-2 shadow-sm bg-white p-3" style="height: 100%;">
        <div class="d-flex justify-content-between align-items-center mb-2">
            <span>PEOPLE</span>
            <div class="dropdown">
                <button class="btn cust-btn" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-ellipsis-h"></i>
                </button>
                <ul class="dropdown-menu cust-btn-menu" aria-labelledby="dropdownMenuButton1">
                    <li><span class="dropdown-item text-success"><i class="fas fa-check-circle"></i> Suggested</span></li>
                    <li><span class="dropdown-item">Random</span></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><span class="dropdown-item">Refresh</span></li>
                </ul>
            </div>
        </div>

        @foreach($users as $user)
        <div class="d-flex align-items-center mb-3">
            <div>
                <img src="/assets/images/default.png" class="border border-3 rounded-circle" alt="default avatar" style="object-fit: contain;" width="50px" height="50px">
            </div>
         
            <div class="d-flex justify-content-between align-items-center p-0 w-100">
                <div class="ms-1">
                    <a href="{{ route('view.user', ['user' => $user->uname]) }}" class="text-decoration-none">
                        <h6 class="d-inline">{{ $user->name }}</h6>
                    </a>
                    <br><span class="mb-2 text-muted" style="font-size: 12px;">@ {{ $user->uname }}</span> 
                </div>
                <div>
                    <button class="btn btn-block btn-secondary btn-sm p-1 d-none" wire:target="followUser({{ $user->id }})" wire:loading.class.remove="d-none">
                        <div class="spinner-grow spinner-grow-sm" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </button>
                   
                    @if($user->auth_user_followed->isEmpty())
                        <button class="btn btn-block btn-info btn-sm p-1" wire:click="followUser({{ $user->id }})" wire:target="followUser({{ $user->id }})" wire:loading.class="d-none"><i class="fas fa-user-plus"></i></button>
                    @else
                        <button class="btn btn-block btn-danger btn-sm p-1" wire:click="followUser({{ $user->id }})" wire:target="followUser({{ $user->id }})" wire:loading.class="d-none"><i class="fas fa-user-minus"></i></button>
                    @endif    
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>