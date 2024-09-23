<div>
     <!-- Product section-->
     <section style="margin-top: 140px">
        <div class="container px-4 px-lg-5 my-5">
            <div class="row gx-4 gx-lg-5 align-items-center">
                <div class="col-md-6 d-flex justify-content-center align-items-center">
                <img class="card-img mb-5 mb-md-0 w-75 img-product" src="{{ asset('storage/' . $selectedProduct->image) }}">
                </div>
                <div class="col-md-6">
                    <h1 class="display-1 fw-bolder title-product">{{ ucwords($selectedProduct->name) }}</h1>
                    <div class="fs-2 mb-5 detail-desc">
                        <span>Rp{{ number_format($selectedProduct->price,2,",",".") }}</span>
                        <span class="fs-1 ms-2 opacity-50">Tersisa {{$selectedProduct->stock->quantity ?? '0'}} pcs</span>
                    </div>
                    <p class="lead fs-1 detail-desc">{{ ucwords($selectedProduct->description) }}</p>
                    <div class="d-flex detail-desc">
                        <div class="quantity-container">
                            <button class="quantity-button" wire:click="decrement({{ $selectedProduct->id }})">-</button>
                            <span class="quantity-display">{{ $quantity }}</span>
                            <button class="quantity-button" wire:click="increment({{ $selectedProduct->id }})">+</button>
                        </div>
                        <button wire:click="redirectToCheckout" class="btn btn-success flex-shrink-0 ms-4">
                            Beli Sekarang
                        </button>
                    </div>
                    <div class="mt-3 detail-desc">
                        <span>Total : Rp{{ number_format($totalPrice,2,",",".") }}</span>
                    </div>
                        @if(session()->has('errorCheckout'))
                            <div class="alert alert-danger text-center mt-2">{{ session('errorCheckout') }}</div>
                        @endif
                </div>
            </div>
        </div>
    </section>

     {{-- Modal --}}
     {{-- <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md">
          <div class="modal-content" style="border-radius: 0;">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">Data Pengirim</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form>
                <div class="mb-3">
                  <label for="name" class="col-form-label">Nama</label>
                  <input type="text" class="form-control" id="name" name="name" wire:model="name">
                </div>
                <div class="mb-3">
                  <label for="alamat" class="col-form-label">Alamat Lengkap</label>
                  <input type="text" class="form-control" id="alamat" name="alamat" wire:model="alamat">
                </div>
                <div class="mb-3">
                    <label for="no_telepon" class="col-form-label">Nomor Handphone</label>
                    <input type="text" class="form-control" id="no_telepon" name="no_telepon" wire:model="no_telepon">
                </div>
                <div class="mb-3">
                    <label for="email" class="col-form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" wire:model="email">
                </div>
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary ms-3 me-5" wire:click="checkout" data-bs-dismiss="modal">Beli</button>
            </div>
          </div>
        </div>
    </div> --}}
    {{-- End Modal --}}

    <!-- Related items section-->
    <section class="py-5 bg-light">
        <div class="container px-4 px-lg-5 mt-5">
            <h2 class="fw-bolder mb-4">Related products</h2>
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                <div class="col mb-5">
                    <div class="card h-100">
                        <!-- Product image-->
                        <img class="card-img-top" src="https://dummyimage.com/450x300/dee2e6/6c757d.jpg" alt="..." />
                        <!-- Product details-->
                        <div class="card-body p-4">
                            <div class="text-center">
                                <!-- Product name-->
                                <h5 class="fw-bolder">Fancy Product</h5>
                                <!-- Product price-->
                                $40.00 - $80.00
                            </div>
                        </div>
                        <!-- Product actions-->
                        <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                            <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="#">View options</a></div>
                        </div>
                    </div>
                </div>
                <div class="col mb-5">
                    <div class="card h-100">
                        <!-- Sale badge-->
                        <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">Sale</div>
                        <!-- Product image-->
                        <img class="card-img-top" src="https://dummyimage.com/450x300/dee2e6/6c757d.jpg" alt="..." />
                        <!-- Product details-->
                        <div class="card-body p-4">
                            <div class="text-center">
                                <!-- Product name-->
                                <h5 class="fw-bolder">Special Item</h5>
                                <!-- Product reviews-->
                                <div class="d-flex justify-content-center small text-warning mb-2">
                                    <div class="bi-star-fill"></div>
                                    <div class="bi-star-fill"></div>
                                    <div class="bi-star-fill"></div>
                                    <div class="bi-star-fill"></div>
                                    <div class="bi-star-fill"></div>
                                </div>
                                <!-- Product price-->
                                <span class="text-muted text-decoration-line-through">$20.00</span>
                                $18.00
                            </div>
                        </div>
                        <!-- Product actions-->
                        <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                            <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="#">Add to cart</a></div>
                        </div>
                    </div>
                </div>
                <div class="col mb-5">
                    <div class="card h-100">
                        <!-- Sale badge-->
                        <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">Sale</div>
                        <!-- Product image-->
                        <img class="card-img-top" src="https://dummyimage.com/450x300/dee2e6/6c757d.jpg" alt="..." />
                        <!-- Product details-->
                        <div class="card-body p-4">
                            <div class="text-center">
                                <!-- Product name-->
                                <h5 class="fw-bolder">Sale Item</h5>
                                <!-- Product price-->
                                <span class="text-muted text-decoration-line-through">$50.00</span>
                                $25.00
                            </div>
                        </div>
                        <!-- Product actions-->
                        <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                            <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="#">Add to cart</a></div>
                        </div>
                    </div>
                </div>
                <div class="col mb-5">
                    <div class="card h-100">
                        <!-- Product image-->
                        <img class="card-img-top" src="https://dummyimage.com/450x300/dee2e6/6c757d.jpg" alt="..." />
                        <!-- Product details-->
                        <div class="card-body p-4">
                            <div class="text-center">
                                <!-- Product name-->
                                <h5 class="fw-bolder">Popular Item</h5>
                                <!-- Product reviews-->
                                <div class="d-flex justify-content-center small text-warning mb-2">
                                    <div class="bi-star-fill"></div>
                                    <div class="bi-star-fill"></div>
                                    <div class="bi-star-fill"></div>
                                    <div class="bi-star-fill"></div>
                                    <div class="bi-star-fill"></div>
                                </div>
                                <!-- Product price-->
                                $40.00
                            </div>
                        </div>
                        <!-- Product actions-->
                        <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                            <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="#">Add to cart</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
