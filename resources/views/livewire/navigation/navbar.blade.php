<div>
    <!-- Navigation-->
        <nav class="navbar navbar-expand-lg fixed-top" style="background-color: rgb(244, 244, 244); box-shadow: rgba(23, 23, 23, 0.08) 0px 4px 12px;">
            <div class="container px-4 px-lg-5">
                <a wire:navigate class="navbar-brand" href="/">Lullaby Closet</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse justify-content-center" id="navbarSupportedContent">
                    <ul class="nav">
                        <li class="nav-item">
                          <a wire:navigate class="nav-link text-dark" href="/">Home</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link text-dark" href="#">All Product</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link text-dark" href="#">New Arrival</a>
                        </li>
                        <li class="nav-item">
                          <a wire:navigate class="nav-link text-dark" href="/admin/products">Administrator</a>
                        </li>
                    </ul>
                    <div class="d-flex justify-content-start align-items-center">
                        <a wire:navigate href="/shop-item" class="btn btn-outline-dark"><i class="bi-cart-fill me-1"></i>
                            Cart
                            <span class="badge bg-dark text-white ms-1 rounded-pill">{{ $cartTotal }}</span>
                        </a>
                    </div>
                </div>
            </div>
        </nav>
</div>
