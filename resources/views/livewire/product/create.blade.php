<div>
    <div class="row mb-3 mt-3">
        <div class="col">
            <form wire:submit.prevent="save">
                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" class="form-control" id="title" aria-describedby="emailHelp" wire:model="title">
                    <div class="text-danger">@error('title') {{ $message }} @enderror</div>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <input type="text" class="form-control" id="description" wire:model="description">
                    <div class="text-danger">@error('description') {{ $message }} @enderror</div>
                </div>
                <div class="mb-3">
                    <label for="price" class="form-label">Price</label>
                    <input type="text" class="form-control" id="price" wire:model="price">
                    <div class="text-danger">@error('price') {{ $message }} @enderror</div>
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label">Image</label>
                    <input type="file" class="form-control" id="image" wire:model="image">
                    <div class="text-danger">@error('image') {{ $message }} @enderror</div>
                    @if($image)
                        <img src="{{ $image->temporaryUrl() }}" alt="" width="250px"; height="250px";>
                    @endif
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
                <button type="button" wire:click="$dispatch('formClose')" class="btn btn-light ms-2">Close</button>
                </form>
        </div>
    </div>
</div>
