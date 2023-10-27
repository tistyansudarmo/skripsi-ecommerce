<div>
    {{-- In work, do what you enjoy. --}}
    @if(session()->has('store'))
        <div class="alert alert-success">{{ session('store') }}</div>
    @endif

     @if(session()->has('update'))
        <div class="alert alert-success">{{ session('update') }}</div>
    @endif

    @if ($formVisible) 
      @if (!$formUpdate)
        @livewire('product.create')
      @else
      <section>
            <div class="container px-4 px-lg-5 mt-5">
                
              <div class="row mb-3">
                  <div class="col">
                      <form wire:submit.prevent="update">
                          <div class="mb-3">
                              <label for="title" class="form-label">Titlee</label>
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
            </div>
        </section>
       @endif
    @endif
    
  <button class="btn btn-danger mb-3" wire:click="$toggle('formVisible')">Create</button>
  
  <div class="table-responsive">
  <table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">No</th>
      <th scope="col">Title</th>
      <th scope="col">Description</th>
      <th scope="col">Price</th>
      <th scope="col">Image</th>
      <th scope="col">Action</th>
      <th scope="col">ID</th>
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
      <td>
        {{-- blade admin --}}
        <button type="button" class="badge text-bg-warning border-0" wire:click="showUpdate({{ $product->id }})">Edit</button> <button type="button" class="badge text-bg-danger border-0" wire:click="delete({{ $product->id }})" wire:confirm="Are you sure you want to delete this post?">Delete</button></td>
      <td>{{ $product->id }}</td>
    </tr> 
    @endforeach
  </tbody>
</table>
</div>
  <div class="mb-5 mt-3">{{ $products->links() }}</div>
</div>


