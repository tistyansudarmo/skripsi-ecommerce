<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
         <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="{{ asset('css/styles.css') }}" rel="stylesheet" />
        <link href="{{ asset('css/card.css') }}" rel="stylesheet" />
        <link href="{{ asset('css/category.css') }}" rel="stylesheet" />
        <title>Lullaby Closet</title>
        @livewireStyles
    </head>
    <body>
        @livewire('navigation.navbar')
        @if (Request::route()->getName() == 'home')
            @livewire('header.header')
        @endif
        <section>
            {{ $slot }}
        </section>

        <footer class="py-2 bg-dark fixed-bottom">
            <div class="container"><p class="m-0 text-center text-white">Copyright &copy; Lullaby Closet 2023</p></div>
        </footer>

        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

        <!-- Core theme JS-->
        <script src="{{ asset('js/scripts.js') }}"></script>
        @livewireScripts
    </body>
</html>
