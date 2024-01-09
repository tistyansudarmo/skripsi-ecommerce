<div>
    <div class="table-responsive container" style="margin-top: 100px">
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
          @foreach ($cart['products'] as $product)
          <tr>
            <th scope="row">{{ $loop->iteration }}</th>
            <td>{{ $product->title }}</td>
            <td>{{ $product->description }}</td>
            <td>Rp{{ number_format($product->price,2,",",".") }}</td>
            <td><img src="{{ asset('storage/'. $product->image) }}" alt="" style="width: 100px; height: 100px;"></td>
            <td>
              {{-- blade admin --}}
            <button type="button" class="badge text-bg-danger border-0" wire:click="removeCart({{ $product->id }})" wire:confirm="Are you sure you want to delete this product?">Delete</button></td>
          </tr>
          @endforeach
        </tbody>
      </table>
      <div class="mb-3">
        <a href="/checkout" class="btn btn-sm btn-primary" wire:navigate>Checkout</a>
      </div>
      </div>
</div>
