<div class="col-md-6 offset-md-0 offset-lg-3">
    <h2>Notifications</h2>

    @if($notifications->isEmpty())
        <h3 class="mt-5 text-center"><i>Nothing to see here...</i></h3>
    @endif

    @foreach($notifications as $notification)
        <a href="#" wire:click.prevent="open({{ $notification->id }})" class="text-decoration-none pe-auto">
            <div  class="border p-3 bg-white d-flex">
                <img src="/assets/images/default.png" class="border border-3 rounded-circle" alt="default avatar" style="object-fit: contain;" width="50px" height="50px">
                <div class="ms-2 d-flex align-items-center"> 
                    <div>
                        <span>{{ $notification->contents }}</span> 
                        <br>
                        <small class="text-secondary">{{ $notification->created_at->format('F d, Y') }}</small>
                    </div>
                    @if($notification->is_read == 0)
                        <small class="ms-2 text-danger"><i class="fas fa-circle"></i></small>
                    @endif
                </div>
            </div>
        </a>
    @endforeach
</div>
