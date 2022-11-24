<div class="container">
    <div class="row">
        <div class="col-md-6">
            <h2>Register</h2>
          
            <div class="border rounded-1 shadow p-3" style="background-color: #ffffff;">
                <form wire:submit.prevent="register">
                    <div class="row">
                        <div class="col">
                            <label>First Name</label>
                            <input type="text" wire:model="fname" class="form-control @error('fname') is-invalid @enderror">
                            @error('fname') <div class="invalid-feedback"> {{ $message }}</div> @enderror
                        </div>
                        <div class="col">
                            <label>Last Name</label>
                            <input type="text" wire:model="lname" class="form-control @error('lname') is-invalid @enderror">
                            @error('lname') <div class="invalid-feedback"> {{ $message }}</div> @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Username</label>
                        <input type="text" wire:model="uname" class="form-control @error('uname') is-invalid @enderror">
                        @error('uname') <div class="invalid-feedback"> {{ $message }}</div> @enderror
                    </div>
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
                    <div class="form-group">
                        <label for="exampleInputPassword1">Confirm Password</label>
                        <input type="password" name="password_confirm" wire:model="password_confirmation"  class="form-control">
                    </div>
                    <button type="submit" class="btn btn-primary mt-2">Register</button>
                </form>
            </div>
        </div>
    </div>
</div>
