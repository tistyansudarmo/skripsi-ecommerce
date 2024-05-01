<div>
    <!-- Navigation-->
        <nav class="navbar navbar-expand-lg fixed-top" style="background-color: rgb(244, 244, 244); box-shadow: rgba(23, 23, 23, 0.08) 0px 4px 12px;">
            <div class="container px-4 px-lg-5">
                <a class="navbar-brand" href="/" wire:navigate>Lullaby Closet</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse justify-content-center" id="navbarSupportedContent">
                    <ul class="nav">
                        <li class="nav-item">
                          <a class="nav-link text-dark" href="/" wire:navigate>Home</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link text-dark" href="#">All Product</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link text-dark" href="#">New Arrival</a>
                        </li>
                        @if (Auth::check())
                        <li class="nav-item">
                          <a class="nav-link text-dark" href="/admin" target="blank">Administrator</a>
                        </li>
                        @endif
                    </ul>
                    <div class="collapse navbar-collapse ms-5 d-flex justify-content-end" id="navbarNavDarkDropdown">
                        <a href="/shop-item" class="btn " wire:navigate><i class="bi-cart-fill"></i>
                            <span class="badge bg-dark text-white rounded-pill">{{ $cartTotal }}</span>
                        </a>
                        @if (Auth::check())
                        <ul class="navbar-nav">
                            <li class="nav-item dropdown">
                            <button class="btn dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                Halo, {{ Auth::user()->full_name }}!
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="/logout">Logout</a></li>
                            </ul>
                            </li>
                        </ul>
                        @else
                        <div class="log">
                            <a href="/login" class="text-decoration-none text-dark" wire:navigate>Login</a>
                        </div>
                        @endif
                      </div>
                </div>
            </div>
        </nav>
</div>
