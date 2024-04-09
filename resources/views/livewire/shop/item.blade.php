<div>
    <div class="table-responsive container" style="margin-top: 100px">
      <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col">No</th>
            <th scope="col">Title</th>
            <th scope="col">Description</th>
            <th scope="col">Price</th>
            {{-- <th scope="col">Stock</th> --}}
            <th scope="col">Image</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
            @forelse ($cart['products'] as $productId)
            @php
                $product = \App\Models\Product::find($productId);
            @endphp
            <tr>
                <th scope="row">{{ $loop->iteration }}</th>
                <td>{{ $product->title }}</td>
                <td>{{ $product->description }}</td>
                <td>Rp{{ number_format($product->price, 2, ",", ".") }}</td>
                {{-- <td>
                @if ($product->stock)
                    {{ $product->stock->quantity }}
                @else
                    0
                @endif</td> --}}
                <td><img src="{{ asset('storage/' . $product->image) }}" alt="" style="width: 100px; height: 100px;"></td>
                <td>
                    {{-- Tombol hapus produk dari keranjang --}}
                    <button type="button" class="badge text-bg-danger border-0" wire:click="removeCart({{ $product->id }})" wire:confirm="Are you sure you want to delete this product?">Delete</button>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="7" class="text-center">No products in your cart.</td>
            </tr>
        @endforelse

        </tbody>
      </table>
      <p>Total Price : Rp{{ number_format($totalPrice, 2, ",", ".") }}</p>
      @if (count($cart['products']) > 0)
        <div class="mb-3">
          <a href="/checkout/{{auth()->user()->id}}" class="btn btn-success btn-sm" wire:navigate>Checkout</a>
        </div>
      @endif
    </div>
  </div>
