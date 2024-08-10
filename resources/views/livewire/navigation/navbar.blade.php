<div>
    <nav class="navbar navbar-expand-lg bg-light fixed-top" data-navbar-on-scroll="data-navbar-on-scroll">
            <div class="container"><a class="navbar-brand text-warning" href="/">Lullaby Closet</a>
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse border-top border-lg-0 mt-4 mt-lg-0" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto">
                  <li class="nav-item"><a class="nav-link" aria-current="page" href="/">Home</a></li>
                  <li class="nav-item"><a class="nav-link" aria-current="page" href="#">All Product</a></li>
                  @if (Auth::check())
                  <li class="nav-item"><a class="nav-link" aria-current="page" href="/admin" target="_blank">Administrator</a></li>
                  <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Halo, {{ Auth::user()->full_name }}!
                    </a>
                    <ul class="dropdown-menu">
                      <li><a class="dropdown-item" href="/order">Pesanan saya</a></li>
                    </ul>
                  </li>
                  @endif
                  <li class="nav-item ms-1 btn-navbar">
                    <a href="/cart" class="btn btn-primary position-relative" style="font-size: 11px">
                        Cart
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size: 10px">
                            {{ $cartTotal }}
                        </span>
                    </a>
                  </li>
                  </ul>
                <div class="d-flex ms-lg-4 btn-navbar">
                 @if (Auth::check())
                 <a class="btn btn-warning" style="font-size: 12px" href="/logout">Logout</a>
                 @else
                 <a class="btn btn-secondary-outline" href="/login" style="font-size: 13px">Sign In</a>
                 <a class="btn btn-warning ms-3" href="/register" style="font-size: 13px">Register</a>
                 @endif
                </div>
              </div>
            </div>
    </nav>
</div>
