<div>
    {{-- In work, do what you enjoy. --}}
    @if(session()->has('store'))
        <div class="alert alert-success">{{ session('store') }}</div>
    @endif

    @if ($formVisible) 
        @livewire('create.create')
    @endif
    <button class="btn btn-danger mb-3" wire:click="$toggle('formVisible')">Create</button>
    <div class="row">
      <div class="col-md-9">
        <select name="" id="" wire:model.live="paginate">
          <option value="5">5</option>
          <option value="10">10</option>
          <option value="15">15</option>
          <option value="20">20</option>
        </select>
      </div>
      <div class="col">
        <input wire:model.live="search">
      </div>
    </div>
   
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
    </tr>
  </thead>
  <tbody>
    @foreach ($products as $product)
    <tr>
      <th scope="row">{{ $loop->iteration }}</th>
      <td>{{ $product->title }}</td>
      <td>{{ $product->description }}</td>
      <td>{{ $product->price }}</td>
      <td><img src="{{ asset('storage/'. $product->image) }}" alt="" style="width: 100px; height: 100px;"></td>
      <td><button class="badge text-bg-warning border-0">Edit</button> <button class="badge text-bg-danger border-0">Delete</button></td>
    </tr> 
    @endforeach
  </tbody>
</table>
</div>
<div class="mb-5 mt-3">{{ $products->links() }}</div>

</div>


