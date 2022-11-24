<div class="container">
    <div class="row">
        <div class="col-md-6">
            <h2>Login</h2>
            <div>
                @if (session()->has('error_message'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error_message') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
            </div>
            <div class="border rounded-1 shadow p-3" style="background-color: #ffffff;">
                <form wire:submit.prevent="login">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" wire:model="email" class="form-control @error('email') is-invalid @enderror">
                        @error('email') <div class="invalid-feedback"> {{ $message }}</div> @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" wire:model="password" class="form-control @error('password') is-invalid @enderror">
                        @error('password') <div class="invalid-feedback"> {{ $message }}</div> @enderror
                    </div>
                    <div class="form-group form-check">
                        <input type="checkbox" wire:model="remember" class="form-check-input">
                        <label class="form-check-label" for="exampleCheck1">Remember Me</label>
                    </div>
                    <button type="submit" class="btn btn-primary">Login</button>
                    <div wire:loading wire:target="login" class="spinner-grow spinner-grow-sm" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <div wire:offline>
                        You are now offline.
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
