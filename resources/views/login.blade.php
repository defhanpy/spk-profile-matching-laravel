<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>SPK Profile Matching - Login</title>

    <!-- Custom fonts -->
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">

    <link href="https://fonts.googleapis.com/css?family=Nunito:200,300,400,600,700,800,900" rel="stylesheet">

    <!-- Custom styles -->
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <div class="row justify-content-center align-items-center vh-100">

            <div class="col-xl-6 col-lg-6 col-md-8">

                <div class="card o-hidden border-0 shadow-lg">

                    <div class="card-body p-5">

                        <!-- ICON -->
                        <div class="text-center mb-4">

                            <div class="mb-3">
                                <i class="fas fa-user-shield fa-4x text-primary"></i>
                            </div>

                            <h1 class="h3 text-gray-900 font-weight-bold">
                                SPK Profile Matching
                            </h1>

                            <p class="small text-gray-600">
                                Silakan login untuk masuk ke dashboard sistem
                            </p>

                        </div>

                        <!-- ERROR -->
                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif

                        <!-- LOGIN FORM -->
                        <form class="user" method="POST" action="{{ url('/login') }}">

                            @csrf

                            <!-- EMAIL -->
                            <div class="form-group">

                                <div class="input-group">

                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-primary text-white border-0">
                                            <i class="fas fa-envelope"></i>
                                        </span>
                                    </div>

                                    <input type="email" class="form-control form-control-user" name="email"
                                        placeholder="Masukkan Email Anda..." required>

                                </div>

                            </div>

                            <!-- PASSWORD -->
                            <div class="form-group">

                                <div class="input-group">

                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-primary text-white border-0">
                                            <i class="fas fa-lock"></i>
                                        </span>
                                    </div>

                                    <input type="password" class="form-control form-control-user" name="password"
                                        placeholder="Password Anda..." required>

                                </div>

                            </div>
                            <hr>

                            <!-- BUTTON -->
                            <button type="submit" class="btn btn-primary btn-user btn-block">

                                <i class="fas fa-sign-in-alt mr-2"></i>
                                Masuk

                            </button>
                        </form>
                    </div>

                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript -->
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>

    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript -->
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts -->
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>

</body>

</html>
