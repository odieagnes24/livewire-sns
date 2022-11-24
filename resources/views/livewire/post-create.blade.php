<div wire:ignore.self class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel">Create a post</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <form wire:submit.prevent="savePost" >
                <nav x-data="{ media_type: @entangle('media_type').defer }">
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <button @click="media_type = 'photo'" class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true"><i class="far fa-file-image"></i></button>
                        <button @click="media_type = 'yt'"class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false"><i class="fab fa-youtube"></i></button>
                        <button @click="media_type = 'soundcloud'"class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-contact" type="button" role="tab" aria-controls="nav-contact" aria-selected="false"><i class="fab fa-soundcloud"></i></button>
                    </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                        <div class="mb-3">
                            <input class="form-control @error('photo') is-invalid @enderror" id="upload{{ $iteration }}" type="file" id="formFile" wire:model="photo">
                            @error('photo') <span class="invalid-feedback">{{ $message }}</span> @enderror
                            <div wire:loading wire:target="photo" class="mt-3">
                                <div class="spinner-grow spinner-grow-sm" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div> Uploading...
                            </div>
                        </div>
                        @if ($photo)
                            <div class="mb-3">
                                <img src="{{ $photo->temporaryUrl() }}" class="rounded border border-2" width="150px" height="150px" style="object-fit: contain;">
                            </div>
                        @endif
                    </div>
                    <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                        <input class="mb-3 form-control @error('yt') is-invalid @enderror" type="text" wire:model.defer="yt" placeholder="Valid YouTube url">
                        @error('yt') <span class="invalid-feedback">{{ $message }}</span> @enderror
                    </div>
                    <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                        <input class="mb-3 form-control @error('soundcloud') is-invalid @enderror" type="text" wire:model.defer="soundcloud" placeholder="Valid Soundcloud Embed">
                        @error('soundcloud') <span class="invalid-feedback">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <textarea class="form-control @error('contents') is-invalid @enderror" wire:model.defer="contents" rows="3" placeholder="Your thoughts..."></textarea>
                    @error('contents') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="row">
                    <div class="col-5">
                        <select wire:model.defer="visibility" class="form-select" aria-label="Visiblity">
                            <option value="Public">Public</option>
                            <option value="Followers Only">Followers Only</option>
                            <option value="Only Me">Only Me</option>
                        </select>
                    </div>
                    <div class="col">
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end align-items-center">
                            <div wire:offline>
                                You are now offline.
                            </div>
                        
                            <button type="submit" class="btn btn-primary">
                                <div wire:target="savePost" wire:loading.class.remove="d-none" class="spinner-grow spinner-grow-sm d-none" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>    
                                <span wire:target="savePost" wire:loading.class="d-none">Post</span> 
                                <span wire:target="savePost" class="d-none" wire:loading.class.remove="d-none">Posting...</span> 
                            </button>
                        </div>
                    </div>
                </div>
        
            </form>
            </div>
            <!-- <div class="modal-footer">
          
            </div> -->
        </div>
    </div>
</div>