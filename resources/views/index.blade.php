<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Lullaby E-Commerce</title>
        <!-- Favicon-->
        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="{{ asset('css/styles.css') }}" rel="stylesheet" />
        @livewireStyles
    </head>
    <body>
        <!-- Navbar-->
        @include('navigation.navbar')
        <!-- Header-->
        <header style="padding-top: 9rem !important;
        padding-bottom: 9rem !important; background-color: #F5F5F5 ">
                       <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                            <img src="" class="d-block w-100" alt="...">
                            </div>
                            <div class="carousel-item">
                            <img src="..." class="d-block w-100" alt="...">
                            </div>
                            <div class="carousel-item">
                            <img src="..." class="d-block w-100" alt="...">
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                        </div>
                </div>
        </header>

        <!-- Section-->
        <section>
            <div class="container px-4 px-lg-5 mt-5">
                @livewire('product.admin')
            </div>
        </section>
        <!-- Footer-->
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
