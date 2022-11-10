<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Hidtzz Store Homepage </title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="{{ asset('landing/css/styles.css') }}" rel="stylesheet" />
    </head>
    <body>
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container px-4 px-lg-5">
                <a class="navbar-brand" href="#!">Hidtzz Store</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                        <li class="nav-item"><a class="nav-link active" aria-current="page" href="#!">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="#!">About</a></li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Shop</a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="#!">All Products</a></li>
                                <li><hr class="dropdown-divider" /></li>
                                <li><a class="dropdown-item" href="#!">Popular Items</a></li>
                                <li><a class="dropdown-item" href="#!">New Arrivals</a></li>
                            </ul>
                        </li>
                    </ul>

                        @if(Auth::check())
                        <a class="btn btn-outline-dark" href="{{ url('cart') }}">
                            <i class="bi-cart-fill me-1"></i>
                            Cart
                            <span class="badge bg-dark text-white ms-1 rounded-pill">0</span>
                        </a>
                        @else
                        <button style="margin-right:10px " class="btn btn-outline-dark" data-bs-toggle="modal" data-bs-target="#login">
                            Login
                        </button>

                        <div class="modal fade" id="login" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">

                                    <form method="POST" action="{{ route('login') }}" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-floating mb-3">
                                          <input name="username" type="text" class="form-control"  placeholder="username" required>
                                          <label for="floatingInput">Username / Email</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                          <input name="password" type="password" class="form-control" placeholder="Password" required>
                                          <label for="floatingPassword">Password</label>
                                        </div>
                                        <div class="d-grid">
                                          <button class="btn btn-primary text-uppercase fw-bold" type="submit">Sign in</button>
                                        </div>
                                    </form>
                                </div>
                              </div>
                            </div>
                        </div>



                        <button class="btn btn-outline-dark" data-bs-toggle="modal" data-bs-target="#register">
                            Register
                        </button>


                        <div class="modal fade" id="register" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">

                                    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-floating mb-3">
                                          <input name="username" type="text" class="form-control"  placeholder="name@example.com" required>
                                          <label for="floatingInput">Username</label>
                                        </div>

                                        <div class="form-floating mb-3">
                                            <input name="password" type="password" class="form-control"  placeholder="Password" required>
                                            <label for="floatingPassword">Password</label>
                                        </div>

                                        <div class="form-floating mb-3">
                                            <input name="email" type="email" class="form-control"  placeholder="name@example.com" required>
                                            <label for="floatingInput">Email</label>
                                        </div>

                                        <div class="form-floating mb-3">
                                            <input name="name" type="text" class="form-control"  placeholder="name@example.com" required>
                                            <label for="floatingInput">Nama Lengkap</label>
                                        </div>

                                        <div class="form-floating mb-3">
                                            <input name="no_hp" type="number" class="form-control"  placeholder="name@example.com" required>
                                            <label for="floatingInput">No Hp</label>
                                        </div>

                                        {{-- <div class="form-floating mb-3">
                                            <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
                                            <label for="floatingInput"></label>
                                        </div> --}}


                                        <div class="d-grid">
                                          <button class="btn btn-primary btn-login text-uppercase fw-bold" type="submit">Sign up</button>
                                        </div>
                                    </form>

                                </div>

                              </div>
                            </div>
                        </div>

                        @endif

                        {{-- <button class="btn btn-outline-dark" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            <i class="bi-cart-fill me-1"></i>
                            Cart
                            <span class="badge bg-dark text-white ms-1 rounded-pill">0</span>
                        </button> --}}

                        {{-- <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-fullscreen-xxl-down">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">Modal </h5>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">

                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                  <button type="button" class="btn btn-primary">Save changes</button>
                                </div>
                              </div>
                            </div>
                        </div> --}}
                </div>
            </div>
        </nav>
        <!-- Header-->
        <header class="bg-dark py-5">
            <div class="container px-4 px-lg-5 my-5">
                <div class="text-center text-white">
                    <h1 class="display-4 fw-bolder">Hidtzz Store</h1>
                    {{-- <p class="lead fw-normal text-white-50 mb-0">With this shop hompeage template</p> --}}
                </div>
            </div>
        </header>
        <!-- Section-->
        <section class="py-5">
            <div class="container px-4 px-lg-5 mt-5">
                <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                    @foreach ($product as $data )
                        <div class="k">
                            <div class="col mb-5">
                                <div class="card h-100">
                                    <!-- Product image-->
                                    <button style="border: none" data-bs-toggle="modal" data-bs-target="#exampleModal{{ $data->id }}">
                                    <img class="kk img-thumbnail" src="https://dummyimage.com/450x300/dee2e6/6c757d.jpg" alt="..." />
                                    </button>
                                    <!-- Product details-->
                                    <div class="card-body p-4">
                                        <div class="text-center">
                                            <!-- Product name-->
                                            <h5 class="fw-bolder">{{ $data->name }}</h5>
                                            <!-- Product price-->
                                            <p class="fst-italic">Rp. {{ number_format($data->price)  }}</p>
                                        </div>
                                        <div class="text-center">
                                            <p class="text-justify"> {{ $data->description}}</p>
                                        </div>
                                    </div>
                                    <!-- Product actions-->
                                    <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                        <div class="text-center">
                                            <a class="btn btn-outline-dark mt-auto" href="{{ url('cart/'.$data->id.'/create') }}">Add to cart</a>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal fade" id="exampleModal{{ $data->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="card">
                                        <div class="card-body">

                                            <div class="card-image">
                                                <span class="card-notify-badge"></span>
                                                <img class="img-fluid" src="https://dummyimage.com/450x300/dee2e6/6c757d.jpg" alt="Alternate Text" />
                                            </div>
                                                <br>
                                            <div class="row">
                                                <div class="col-6">
                                                    <h6 class="text-center">{{ $data->name }}</h6>
                                                    <br>
                                                    <p class="text-center">{{ $data->description }}</p>
                                                </div>
                                                <div class="col-6 text-center">
                                                    <br>
                                                    <p class="fst-italic">Rp. {{ number_format($data->price) }}</p>
                                                </div>
                                            </div>

                                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                                <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="{{ url('cart/'.$data->id.'/create') }}">Add to cart</a></div>

                                            </div>



                                        </div>
                                    </div>
                                </div>

                              </div>
                            </div>
                          </div>
                    @endforeach


                    </div>
                </div>
            </div>
        </section>
        <!-- Footer-->
        <footer class="py-5 bg-dark">
            <div class="container"><p class="m-0 text-center text-white">Copyright &copy; Hidtzz Store @php echo date('Y') @endphp</p></div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="{{ asset('landing/js/scripts.js') }}"></script>
        @include('sweetalert::alert')
    </body>
</html>
