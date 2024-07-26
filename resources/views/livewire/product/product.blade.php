<div>
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
     <!-- Product section-->
     <section class="py-2">
        <div class="container px-4 px-lg-5 my-5">
            <div class="row gx-4 gx-lg-5 align-items-center">
                <div class="col-md-6">
                <img class="card-img mb-5 mb-md-0" src="{{ asset('storage/' . $selectedProduct->image) }}">
                </div>
                <div class="col-md-6">
                    <h1 class="display-5 fw-bolder">{{ $selectedProduct->title }}</h1>
                    <div class="fs-5 mb-5">
                        <span>Rp{{ number_format($selectedProduct->price,2,",",".") }}</span>
                        <span class="fs-6 ms-2 opacity-50">Tersisa {{$selectedProduct->stock->quantity}} pcs</span>
                    </div>
                    <p class="lead">{{ $selectedProduct->description }}</p>
                    <div class="d-flex">
                        <div class="quantity-container">
                            <button class="quantity-button" wire:click="decrement({{ $selectedProduct->id }})">-</button>
                            <span class="quantity-display">{{ $quantity }}</span>
                            <button class="quantity-button" wire:click="increment({{ $selectedProduct->id }})">+</button>
                        </div>
                        <button class="btn btn-success flex-shrink-0 ms-4" type="button" wire:click="checkout" wire:confirm="Are you sure you want to buy this product?">
                            {{-- <i class="bi-cart-fill me-1"></i> --}}
                            Beli Sekarang
                        </button>
                    </div>
                    <div class="fs-6 mt-3">
                        <span>Total : Rp{{ number_format($totalPrice,2,",",".") }}</span>
                    </div>
                </div>
            </div>
        </div>
    </section>
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
