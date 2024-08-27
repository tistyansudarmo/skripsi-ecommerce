<div class="container">
        <ul class="nav justify-content-center bg-light d-lg-none fixed-bottom gap-4">
            <li class="nav-item">
                <div class="d-flex flex-column align-items-center">
                    <a class="nav-link active" href="/" style="font-size: 24px; margin-bottom:-12px"><i class="bi bi-house-door"></i></a>
                    <span style="font-size:12px;">Home</span>
                </div>
            </li>
            <li class="nav-item">
                <div class="d-flex flex-column align-items-center">
                    <a class="nav-link" href="/order" style="font-size: 24px; margin-bottom:-12px"><i class="bi bi-bag-heart"></i></a>
                    <span style="font-size: 12px;">Order</span>
                </div>
            </li>
            <li class="nav-item">
                <div class="d-flex flex-column align-items-center">
                    <a class="nav-link position-relative" href="/cart" style="font-size: 24px; margin-bottom:-12px">
                      <i class="bi bi-cart-check"></i>
                      <span class="position-absolute top-20 start-75 translate-middle badge rounded-pill bg-danger" style="font-size: 11px;">
                        {{ $cartTotal }}
                      </span>
                    </a>
                    <span style="font-size: 12px;">Cart</span>
                </div>
              </li>
            <li class="nav-item">
                <div class="d-flex flex-column align-items-center">
                    @if (Auth::check())
                        <a class="nav-link" href="/logout" style="font-size: 24px; margin-bottom:-12px"><i class="bi bi-box-arrow-right"></i></a>
                        <span style="font-size: 12px;">Logout</span>
                    @else
                        <a class="nav-link" href="/login" style="font-size: 24px; margin-bottom:-12px"><i class="bi bi-box-arrow-in-right"></i></a>
                        <span style="font-size: 12px;">Login</span>
                    @endif
                </div>
            </li>
          </ul>
</div>
