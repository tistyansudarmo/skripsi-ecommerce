<div>
    {{-- In work, do what you enjoy. --}}
    @if(session()->has('store'))
        <div class="alert alert-success mt-4">{{ session('store') }}</div>
    @endif

     @if(session()->has('update'))
        <div class="alert alert-success mt-4">{{ session('update') }}</div>
    @endif

    @if ($formVisible)
      @if (!$formUpdate)
        @livewire('admin.create-products')
      @else
        <div class="row mb-3 mt-3">
                  <div class="col">
                      <form wire:submit.prevent="update">
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
                              <label for="quantity" class="form-label">Quantity</label>
                              <input type="number" class="form-control" id="quantity" wire:model="quantity">
                              <div class="text-danger">@error('quantity') {{ $message }} @enderror</div>
                          </div>
                          <div class="mb-3">
                            <label for="category" class="form-label">Category</label>
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
                                  <img src="{{ $image->temporaryUrl() }}" alt="" width="250px"; height="250px"; class="mt-3">
                              @else
                                  <img src="{{ $imageOld }}" alt="" width="250px"; height="250px"; class="mt-3">
                              @endif
                          </div>
                          <button type="submit" class="btn btn-primary">Submit</button>
                          <button type="button" wire:click="$dispatch('formClose')" class="btn btn-light ms-2">Close</button>
                          </form>
                  </div>
            </div>
       @endif
    @endif

@if (!$formVisible)
<button class="btn btn-danger mb-3 mt-3" wire:click="$toggle('formVisible')" style="z-index: 5000">Create</button>
@endif
    <div class="table-responsive">
    <table class="table table-striped">
    <thead>
        <tr>
        <th scope="col">No</th>
        <th scope="col">Title</th>
        <th scope="col">Description</th>
        <th scope="col">Price</th>
        <th scope="col">Image</th>
        <th scope="col">Quantity</th>
        <th scope="col">Category</th>
        <th scope="col" class="text-center">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($products as $product)
        <tr>
        <th scope="row">{{ $loop->iteration }}</th>
        <td>{{ $product->title }}</td>
        <td>{{ $product->description }}</td>
        <td>Rp{{ number_format($product->price,2,",",".") }}</td>
        <td><img src="{{ asset('storage/'. $product->image) }}" alt="" style="width: 100px; height: 100px;"></td>
        <td class="text-center">
        @if ($product->stock)
        <p>{{ $product->stock->quantity }}</p>
        @else
        <p>0</p>
        @endif
        </td>
        <td>{{ optional($product->category)->name }}</td>
        <td>
            <div class="d-flex justify-content-between">
                <button type="button" class="badge text-bg-warning border-0 me-2" wire:click="showUpdate({{ $product->id }})">Edit</button> <button type="button" class="badge text-bg-danger border-0" wire:click="delete({{ $product->id }})" wire:confirm="Are you sure you want to delete this post?">Delete</button></td>
            </div>
        <td>
        </tr>
        @endforeach
    </tbody>
    </table>
    </div>
  <div class="mb-5 mt-3">{{ $products->links() }}</div>
</div>
