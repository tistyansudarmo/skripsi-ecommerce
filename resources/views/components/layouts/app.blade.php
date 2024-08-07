<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="{{asset('css/card.css')}}" rel="stylesheet" />
        <link href="{{asset('css/category.css') }}" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&amp;family=Volkhov:wght@700&amp;display=swap" rel="stylesheet">
        <link href="{{ asset('css/theme.css') }}" rel="stylesheet" />
        <title>Lullaby Closet</title>
        @livewireStyles
    </head>

    <body>
        @livewire('navigation.navbar')
        @if (request()->route()->getName() == 'home')
        <!-- Slider main container -->
        {{-- <div class="swiper mySwiper">
            <div class="swiper-wrapper">
              <div class="swiper-slide"><img src="{{ asset('images/photo1.jpg') }}" alt=""></div>
              <div class="swiper-slide"><img src="{{ asset('images/photo2.jpg') }}" alt=""></div>
              <div class="swiper-slide"><img src="{{ asset('images/photo3.jpg') }}" alt=""></div>
              <div class="swiper-slide"><img src="{{ asset('images/photo4.jpg') }}" alt=""></div>
            </div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div> --}}

        <main class="main" id="top">
            <section class="pt-7" style="margin-top: 120px">
              <div class="container">
                <div class="row align-items-center">
                  <div class="col-md-6 text-md-start text-center py-6">
                    <h1 class="mb-4 fs-9 fw-bold">Curated Collection for the Modern Woman</h1>
                    <p class="mb-6 lead text-secondary">Find your unique fashion with our handpicked selection. Your Style, Your Story!</p>
                    <div class="text-center text-md-start">
                        <button class="btn btn-lg btn-warning" id="scrollToSearch">Our Products</button>
                    </div>
                  </div>
                  <div class="col-md-6 text-end">
                    <img class="pt-7 pt-md-0 img-fluid" src="assets/images/hero/hero-img.png" alt="" />
                  </div>
                </div>
              </div>
            </section>
          </main>
        @endif
        <section>
            {{ $slot }}
        </section>
        <script src="{{ asset('js/scripts.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <script>
            document.getElementById("scrollToSearch").addEventListener("click", function() {
            document.getElementById("searchInput").scrollIntoView({ behavior: "smooth" });
            document.getElementById("searchInput").focus();
        });
        </script>
        @livewireScripts
    </body>
</html>
