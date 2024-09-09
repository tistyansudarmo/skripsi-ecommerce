<div>
    <div class="row mb-3 mt-3">
        <div class="col">
            <form wire:submit.prevent="save">
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" aria-describedby="emailHelp" wire:model="name">
                    <div class="text-danger">@error('name') {{ $message }} @enderror</div>
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
                    <label for="quantity" class="form-label">Quantity</label>
                    <input type="number" class="form-control" id="quantity" wire:model="quantity">
                    <div class="text-danger">@error('quantity') {{ $message }} @enderror</div>
                </div>
                <div class="mb-3">
                    <label for="size" class="form-label">Size</label>
                    <input type="text" class="form-control" id="size" wire:model="size">
                    <div class="text-danger">@error('size') {{ $message }} @enderror</div>
                  </div>
                <div class="mb-3">
                    <label for="quantity" class="form-label">Category</label>
                    <select class="form-select" aria-label="Default select example" id="category" wire:model="selectedCategory">
                        <option value="">--- Pilih Category ---</option>
                        @foreach ($category as $categories)
                        <option value="{{$categories->id}}">{{$categories->name}}</option>
                        @endforeach
                      </select>
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
