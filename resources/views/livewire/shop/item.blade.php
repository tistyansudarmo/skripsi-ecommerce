<div class="container">
    <style>
        .quantity-container {
            display: flex;
            align-items: center;
        }

        .quantity-button {
            background-color: #f8f9fa;
            border: 1px solid #ced4da;

            border-radius: 0.25rem;
            cursor: pointer;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .quantity-button:hover {
            background-color: #e2e6ea;
        }

        .quantity-display {
            margin: 0 0.75rem;
        }

        @media (max-width: 768px) {
        .product-info .col-md-5,
        .product-info .col-md-4,
        .product-info .col-md-3  {
            width: 80%;
            text-align: center;
        }
        .product-info .col-md-3 .quantity-container {
            justify-content: center;
        }

        .product-info .col-md-4 .stock{
            margin-left: 0px !important;
        }
     }

    </style>

    @if(session()->has('checkout'))
    <div class="alert alert-success mt-4">{{ session('checkout') }}</div>
    @endif

    @if(session()->has('errorCheckout'))
    <div class="alert alert-danger mt-4">{{ session('errorCheckout') }}</div>
    @endif
    <div class="row mt-4">
        <div class="col-xl-12">
            @if (count($cart) > 0)
                <div class="row">
                    <div class="col-xl-7">
                        @foreach ($cart as $item)
                        <div class="card border shadow-none mb-3">
                            <div class="card-body">
                                <div class="d-flex align-items-start border-bottom pb-3">
                                    <div class="me-4">
                                        <img src="{{ asset('storage/' . $item->image) }}" alt="" style="width: 100px; height: 100px;">
                                    </div>
                                    <div class="flex-grow-1 align-self-center overflow-hidden">
                                        <div>
                                            <h5 class="text-truncate font-size-18 fw-bold" style="margin-bottom: -12px">{{ $item->title }}</h5>
                                            <p class="mb-0">{{ $item->description }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <div class="row">
                                        <div class="product-info d-flex flex-row justify-content-center">
                                            <div class="col-md-5">
                                                <div class="mt-3">
                                                    <p class="text-muted mb-2 fw-bold">Price</p>
                                                    <h5 class="mb-0 mt-2">Rp{{ number_format($item->price, 2, ",", ".") }}</h5>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="mt-3">
                                                    <p class="text-muted mb-2 fw-bold">Stock</p>
                                                    <h5 class="ms-3 stock">{{ $item->product->stock->quantity }}</h5>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="mt-3">
                                                    <p class="text-muted mb-2 fw-bold">Quantity</p>
                                                    <div class="quantity-container">
                                                        <button wire:click="decrement" wire:model="qty" class="quantity-button">-</button>
                                                        <span class="quantity-display">{{ $qty }}</span>
                                                        <button wire:click="increment" wire:model="qty" class="quantity-button">+</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-grid d-md-block">
                                        <button class="btn btn-danger btn-sm mt-2" wire:click="removeCart({{ $item->id }})" wire:confirm="Are you sure you want to delete this product?" style="margin-top: -20px">Delete</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <div class="col-xl-5">
                        <div class="mt-lg-0 mt-3 mb-4">
                            <div class="card border shadow-none">
                                <div class="card-header bg-transparent border-bottom py-3 px-4">
                                    <p class="font-size-16 mb-0">Order Summary</p>
                                </div>
                                <div class="card-body p-4 pt-2">
                                    <div class="table-responsive">
                                        <table class="table mb-0">
                                            <tbody>
                                                <tr>
                                                    <td>Sub Total</td>
                                                    <td class="text-end">Rp{{ number_format($totalPrice, 2, ",", ".") }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Discount</td>
                                                    <td class="text-end">0</td>
                                                </tr>
                                                <tr>
                                                    <td>Alamat</td>
                                                    <td class="text-end">{{ auth()->user()->alamat }}</td>
                                                </tr>
                                                <tr class="bg-light">
                                                    <th>Total :</th>
                                                    <td class="text-end">
                                                        <span class="fw-bold">
                                                            Rp{{ number_format($totalPrice, 2, ",", ".") }}
                                                        </span>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="mt-3 d-grid d-md-block">
                                        <button class="btn btn-success btn-sm" wire:click="checkout" wire:confirm="Are you sure you want to buy this product?">Checkout</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="alert alert-secondary text-center">
                    <h4 class="alert-heading">Keranjang Kosong</h4>
                    <p>Tidak ada produk di keranjang Anda saat ini. Silakan tambahkan produk untuk melanjutkan.</p>
                </div>
            @endif
        </div>
    </div>

  </div>
