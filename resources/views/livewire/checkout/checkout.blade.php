<div class="container" style="margin-top: 100px">
    @if(session()->has('errorCheckout'))
    <div class="alert alert-danger mt-4">{{ session('errorCheckout') }}</div>
    @endif
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <ol class="activity-checkout mb-0 px-4 mt-3">
                        <li class="checkout-item">
                            <div class="avatar checkout-icon p-1">
                                <div class="avatar-title rounded-circle bg-primary">
                                    <i class="bx bxs-receipt text-white font-size-20"></i>
                                </div>
                            </div>
                            <div class="feed-item-list">
                                <div>
                                    <h5 class="font-size-16 mb-1">Shipping Address</h5>
                                    <div class="mb-3">
                                        <form>
                                            <div>
                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        <div class="mb-4">
                                                            <label class="form-label" for="billing-name">Name</label>
                                                            <p>{{ $sellerName }}</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="mb-4">
                                                            <label class="form-label" for="billing-email-address">Address</label>
                                                            <p>{{ $sellerAddress }}</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="mb-4">
                                                            <label class="form-label" for="billing-phone">Phone</label>
                                                            <p>{{ $sellerPhone }}</p>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        <div class="mb-4 mb-lg-0">
                                                            <label class="form-label" for="billing-province">Province</label>
                                                            <p>{{ $sellerProvince }}</p>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-4">
                                                        <div class="mb-4 mb-lg-0">
                                                            <label class="form-label" for="billing-city">City</label>
                                                            <p>{{ $sellerCity }}</p>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-4">
                                                        <div class="mb-0">
                                                            <label class="form-label" for="zip-code">Postal code</label>
                                                            <p>{{ $sellerPostalCode }}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="checkout-item">
                            <div class="avatar checkout-icon p-1">
                                <div class="avatar-title rounded-circle bg-primary">
                                    <i class="bx bxs-wallet-alt text-white font-size-20"></i>
                                </div>
                            </div>
                            <div class="feed-item-list">
                                <div>
                                    <h5 class="font-size-16 mb-1">Destination Address</h5>
                                    <div class="mb-3">
                                        <form>
                                            <div>
                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="billing-name">Name</label>
                                                            <input type="text" class="form-control" id="billing-name" placeholder="Enter name" wire:model="buyerName" disabled>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="billing-email-address">Email Address</label>
                                                            <input type="email" class="form-control" id="billing-email-address" placeholder="Enter email" wire:model="buyerEmail" disabled>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="billing-phone">Phone</label>
                                                            <input type="text" class="form-control" id="billing-phone" placeholder="Enter Phone number" wire:model="buyerPhone">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="mt-3">
                                                    <label class="form-label" for="billing-address">Address</label>
                                                    <textarea class="form-control" id="billing-address" rows="3" placeholder="Enter full address" wire:model="buyerAddress"></textarea>
                                                </div>

                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        <div class="mt-4 mb-lg-0">
                                                            <label class="form-label">Province</label>
                                                            <select class="form-control form-select" title="province" wire:model.live="buyerProvince" wire:change="shippingCost">
                                                                <option value="">Select Province</option>
                                                                @foreach ($province as $provinsi)
                                                                <option value="{{ $provinsi['id'] }}">{{ $provinsi['name'] }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-4">
                                                        <div class="mt-4 mb-lg-0">
                                                            <label class="form-label">City</label>
                                                            <select class="form-control form-select" title="city" wire:model="buyerCity" wire:change="shippingCost">
                                                                <option value="">Select City</option>
                                                                @foreach ($city as $kota)
                                                                <option value="{{ $kota['id'] }}">{{ $kota['name'] }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-4">
                                                        <div class="mt-4">
                                                            <label class="form-label" for="zip-code">Postal code</label>
                                                            <input type="text" class="form-control" id="zip-code" placeholder="Enter Postal code" wire:model="buyerPostalCode">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="mt-4 mb-lg-0">
                                                            <label class="form-label">Expedition</label>
                                                            <select class="form-control form-select" title="courier" wire:model="courier" wire:change="shippingCost" required>
                                                                <option value="">Select Expedition</option>
                                                                <option value="jne">JNE</option>
                                                                <option value="pos">POS</option>
                                                                <option value="tiki">TIKI</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="mt-4 mb-lg-0">
                                                            <label class="form-label">Select Shipping Option</label>
                                                            <select class="form-control form-select" title="courier" wire:model="shipping" required>
                                                                <option value="">Select Shipping</option>
                                                                @if ($getShippingCosts)
                                                                    @foreach ($getShippingCosts['costs'] as $cost)
                                                                    <option value="{{ $cost['service'] }} {{ $cost['cost'][0]['value'] }} {{ $cost['cost'][0]['etd'] }}">{{ $cost['service'] }}: Rp{{ number_format($cost['cost'][0]['value'], 2, ',', '.') }} ({{ $cost['cost'][0]['etd'] }} days)</option>
                                                                    @endforeach
                                                                @endif
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="checkout-item">
                            <div class="avatar checkout-icon p-1">
                                <div class="avatar-title rounded-circle bg-primary">
                                    <i class="bx bxs-receipt text-white font-size-20"></i>
                                </div>
                            </div>
                            @if($selectedProduct)
                            <div class="feed-item-list">
                                <div>
                                    <h5 class="font-size-16 mb-1">Purchased Products</h5>
                                    <div class="mb-3">
                                        <form>
                                            <div>
                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        <div class="mb-4 mb-lg-0">
                                                            <label class="form-label" for="billing-city">Image</label>
                                                            <img class="card-img mb-5 mb-md-0 w-75 h-75 d-flex" src="{{ asset('storage/' . $selectedProduct->image) }}" alt="" style="width: 100px; height: 100px;">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="mb-4">
                                                            <label class="form-label" for="desc">Description</label>
                                                            <p>{{ $selectedProduct->description }}</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="mb-4">
                                                            <label class="form-label" for="name">Name</label>
                                                            <p>{{ $selectedProduct->name }}</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="mb-4 mt-3">
                                                            <label class="form-label" for="size">Size</label>
                                                            <p>{{ $selectedProduct->size }}</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="mb-4 mt-3 mb-lg-0">
                                                            <label class="form-label" for="billing-price">Price</label>
                                                            <p>Rp{{ number_format($selectedProduct->price,2,",",".") }}</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="mb-4 mt-3 mb-lg-0">
                                                            <label class="form-label" for="qty">Weight</label>
                                                              <p>{{$selectedProduct->weight }} gram</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="mb-4 mt-3 mb-lg-0">
                                                            <label class="form-label" for="qty">Quantity</label>
                                                            <p>{{ $qty }}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr class="dropdown-divider">
                                                <div class="col-lg-4">
                                                    <div class="mb-4 mt-3 mb-lg-0">
                                                        <label class="form-label" for="billing-price">Total Price</label>
                                                        <p>Rp{{ number_format($totalPrice,2,",",".")}}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            @else
                            <div class="feed-item-list">
                                <div>
                                    <h5 class="font-size-16 mb-1">Purchased Products</h5>
                                    <div class="mb-3">
                                        <form>
                                            <div>
                                                @foreach ($cart as $item)
                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        <div class="mb-4 mb-lg-0">
                                                            <label class="form-label" for="billing-city">Image</label>
                                                            <img class="card-img mb-5 mb-md-0 w-75 h-75 d-flex" src="{{ asset('storage/' . $item->image) }}" alt="" style="width: 100px; height: 100px;">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="mb-4">
                                                            <label class="form-label" for="desc">Description</label>
                                                            <p>{{ $item->description }}</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="mb-4">
                                                            <label class="form-label" for="name">Name</label>
                                                            <p>{{ $item->name }}</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="mb-4 mt-3">
                                                            <label class="form-label" for="size">Size</label>
                                                            <p>{{ $item->size }}</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="mb-4 mt-3 mb-lg-0">
                                                            <label class="form-label" for="billing-price">Price</label>
                                                            <p>Rp{{ number_format($item->price,2,",",".") }}</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="mb-4 mt-3 mb-lg-0">
                                                            <label class="form-label" for="qty">Weight</label>
                                                              <p>{{$item->product->weight }} gram</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="mb-4 mt-3 mb-lg-0">
                                                            <label class="form-label" for="qty">Quantity</label>
                                                              <p>{{ session('totalQtyCart')[$item->id] }}</p>
                                                        </div>
                                                    </div>
                                                    <hr class="dropdown-divider">
                                                @endforeach
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="mb-4 mt-3 mb-lg-0">
                                                    <label class="form-label" for="billing-price">Total Price</label>
                                                    <p>Rp{{ number_format($totalPriceCart,2,",",".")}}</p>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </li>
                    </ol>
                </div>
            </div>
            <div class="row my-4">
                <div class="col">
                    <div class="text-start mt-2 mt-sm-0">
                        <button class="btn btn-success" wire:click="checkout" >Process</button>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row-->
        </div>
    </div>
    <script type="text/javascript"
    src="https://app.sandbox.midtrans.com/snap/snap.js"
    data-client-key="{{ config('services.midtrans.client_key') }}">
    </script>

    <script type="text/javascript">
        // Replace with the ID of your pay button
        var payButton = document.getElementById('pay-button');

        payButton.addEventListener('click', function () {
          // Trigger snap popup. @TODO: Replace TRANSACTION_TOKEN_HERE with your transaction token
          window.snap.pay('{{ $snapToken }}', {
            onSuccess: function(result) {
              /* Redirect to order page on successful payment */
              window.location.href = '/order'; // Replace '/orders/' with your actual order URL prefix
              alert("Payment Success!");
            },
            onPending: function(result) {
              /* You may add your own implementation here */
              alert("Waiting for your payment!");
            },
            onError: function(result) {
              /* You may add your own implementation here */
              alert("Payment failed!");
            },
            onClose: function(){
              /* You may add your own implementation here */
              alert('You closed the popup without finishing the payment');
            }
          });
        });
      </script>
    <!-- end row -->
</div>
