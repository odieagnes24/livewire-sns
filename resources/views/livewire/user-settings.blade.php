<div class="col-md-6 offset-md-0 offset-lg-3">
    <h2>Settings</h2>

    <h5 class="mt-4">ACCOUNT</h5>
    <form wire:submit.prevent="updateInfo">
        <div class="mb-2">
            <label class="form-label">First name</label>
            <input type="text" class="form-control @error('fname') is-invalid @enderror" wire:model="fname">
            @error('fname') <div class="invalid-feedback"> {{ $message }}</div> @enderror
        </div>
        <div class="mb-2">
            <label class="form-label">Last name</label>
            <input type="text" class="form-control @error('lname') is-invalid @enderror" wire:model="lname">
            @error('lname') <div class="invalid-feedback"> {{ $message }}</div> @enderror
        </div>
        <div class="mb-2">
            <label class="form-label">Username</label>
            <input type="text" class="form-control @error('uname') is-invalid @enderror" wire:model="uname">
            @error('uname') <div class="invalid-feedback"> {{ $message }}</div> @enderror
        </div>
        <div class="mb-2">
            <label class="form-label">Email</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" wire:model="email">
            @error('email') <div class="invalid-feedback"> {{ $message }}</div> @enderror
        </div>

        <div class="w-100 d-flex justify-content-end">
            <button type="submit" class="mt-2 btn btn-primary">
                <div wire:target="updateInfo" wire:loading.class.remove="d-none" class="spinner-grow spinner-grow-sm d-none" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>    
                <span wire:target="updateInfo" wire:loading.class="d-none">Update</span> 
                <span wire:target="updateInfo" class="d-none" wire:loading.class.remove="d-none">Updating...</span> 
            </button>
        </div>

    </form>

    <h5 class="mt-4">PASSWORD</h5>
    <form class="mb-5" wire:submit.prevent="updatePassword">
        <div class="mb-2">
            <label class="form-label">New password</label>
            <input type="password" class="form-control  @error('password') is-invalid @enderror" wire:model="password">
            @error('password') <div class="invalid-feedback"> {{ $message }}</div> @enderror
        </div>
        <div class="mb-2">
            <label class="form-label">Re-type new password</label>
            <input type="password" class="form-control" wire:model="password_confirmation">
        </div>

        <div class="w-100 d-flex justify-content-end">
            <button class="mt-2 btn btn-primary" type="submit">
                <div wire:target="updatePassword" wire:loading.class.remove="d-none" class="spinner-grow spinner-grow-sm d-none" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>    
                <span wire:target="updatePassword" wire:loading.class="d-none">Update</span> 
                <span wire:target="updatePassword" class="d-none" wire:loading.class.remove="d-none">Updating...</span> 
            </button>
        </div>
    </form>
</div>
