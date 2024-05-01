<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="{{asset('css/styles.css')}}" rel="stylesheet" />
        <link href="{{asset('css/card.css')}}" rel="stylesheet" />
        <link href="{{asset('css/category.css') }}" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
        <title>Lullaby Closet</title>
        @livewireStyles
    </head>
    <style>

    .swiper {
        width: 100%;
        height: 60vh;
        margin-top: 40px;
        }

    .swiper-slide {
      text-align: center;
      font-size: 10px;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .swiper-slide img {
        width: 80%;
        object-fit: cover;
        display: block;
    }



    </style>
    <body>
        @livewire('navigation.navbar')
        @if (request()->route()->getName() == 'home')
        <!-- Slider main container -->
        <div class="swiper mySwiper">
            <div class="swiper-wrapper">
              <div class="swiper-slide"><img src="{{ asset('images/photo1.jpg') }}" alt=""></div>
              <div class="swiper-slide"><img src="{{ asset('images/photo2.jpg') }}" alt=""></div>
              <div class="swiper-slide"><img src="{{ asset('images/photo3.jpg') }}" alt=""></div>
              <div class="swiper-slide"><img src="{{ asset('images/photo4.jpg') }}" alt=""></div>
            </div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
          </div>
        @endif
        <section>
            {{ $slot }}
        </section>

        {{-- <footer class="py-2 bg-dark fixed-bottom">
            <div class="container"><p class="m-0 text-center text-white">Copyright &copy; Lullaby Closet 2023</p></div>
        </footer> --}}
        <script src="{{ asset('js/scripts.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
        <script>
            var swiper = new Swiper(".mySwiper", {
                navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
              autoplay: {
                delay: 2500,
                },


            });
          </script>
          <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        @livewireScripts
    </body>
</html>
