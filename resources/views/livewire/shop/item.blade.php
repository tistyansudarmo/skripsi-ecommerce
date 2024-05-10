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
            <th scope="col">Available</th>
            <th scope="col">Quantity</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
            @forelse ($cart as $item)
            <tr>
                <th scope="row">{{ $loop->iteration }}</th>
                <td>{{ $item->title }}</td>
                <td>{{ $item->description }}</td>
                <td>Rp{{ number_format($item->price, 2, ",", ".") }}</td>
                <td><img src="{{ asset('storage/' . $item->image) }}" alt="" style="width: 100px; height: 100px;"></td>
                <td>{{ $item->product->stock->quantity }} pcs</td>
                <td>
                    {{-- <input type="number" style="width: 55px; text-align:center" wire:model="qty" id="quantityInput"> --}}
                    <button wire:click="decrement" wire:model="qty">-</button>
                    {{ $qty }}
                    <button wire:click="increment" wire:model="qty">+</button>
                </td>
                <td>
                    {{-- Tombol hapus produk dari keranjang --}}
                    <button class="badge text-bg-danger border-0" wire:click="removeCart({{ $item->id }})" wire:confirm="Are you sure you want to delete this product?">Delete</button>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="8" class="text-center">No products in your cart.</td>
            </tr>
        @endforelse

        @if(session()->has('checkout'))
        <div class="alert alert-success mt-4">{{ session('checkout') }}</div>
        @endif

        @if(session()->has('errorCheckout'))
        <div class="alert alert-danger mt-4">{{ session('errorCheckout') }}</div>
        @endif

        </tbody>
      </table>
      <p>Total Price : Rp{{ number_format($totalPrice, 2, ",", ".") }}</p>
      @if (count($cart) > 0)
        <div class="mb-3">
          <button class="btn btn-success btn-sm" wire:click="checkout" wire:confirm="Are you sure you want to buy this product?">Checkout</button>
        </div>
      @endif
    </div>
  </div>
