{{-- <!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ config('app.name') }} | Registration Page</title>

    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css"
        integrity="sha512-0S+nbAYis87iX26mmj/+fWt1MmaKCv80H+Mbo+Ne7ES4I6rxswpfnC6PxmLiw33Ywj2ghbtTw0FkLbMWqh4F7Q=="
        crossorigin="anonymous" />

    <!-- AdminLTE -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.0.5/css/adminlte.min.css"
        integrity="sha512-rVZC4rf0Piwtw/LsgwXxKXzWq3L0P6atiQKBNuXYRbg2FoRbSTIY0k2DxuJcs7dk4e/ShtMzglHKBOJxW8EQyQ=="
        crossorigin="anonymous" />

    <!-- iCheck -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/icheck-bootstrap/3.0.1/icheck-bootstrap.min.css"
        integrity="sha512-8vq2g5nHE062j3xor4XxPeZiPjmRDh6wlufQlfC6pdQ/9urJkU07NM0tEREeymP++NczacJ/Q59ul+/K2eYvcg=="
        crossorigin="anonymous" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body class="hold-transition register-page">
    <div class="register-box">
        <div class="register-logo">
            <a href="{{ url('/home') }}"><b>{{ config('app.name') }}</b></a>
        </div>

        <div class="card">
            <div class="card-body register-card-body">
                <p class="login-box-msg">Register a new membership</p>

                <form method="post" action="{{ route('register') }}">
                    @csrf

                    <div class="input-group mb-3">
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                            value="{{ old('name') }}" placeholder="Full name">
                        <div class="input-group-append">
                            <div class="input-group-text"><span class="fas fa-user"></span></div>
                        </div>
                        @error('name')
                            <span class="error invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" name="username" class="form-control @error('name') is-invalid @enderror"
                            value="{{ old('username') }}" placeholder="username">
                        <div class="input-group-append">
                            <div class="input-group-text"><span class="fas fa-user"></span></div>
                        </div>
                        @error('username')
                            <span class="error invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="input-group mb-3">
                        <input type="email" name="email" value="{{ old('email') }}"
                            class="form-control @error('email') is-invalid @enderror" placeholder="Email">
                        <div class="input-group-append">
                            <div class="input-group-text"><span class="fas fa-envelope"></span></div>
                        </div>
                        @error('email')
                            <span class="error invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="input-group mb-3">
                        <input type="password" name="password"
                            class="form-control @error('password') is-invalid @enderror" placeholder="Password">
                        <div class="input-group-append">
                            <div class="input-group-text"><span class="fas fa-lock"></span></div>
                        </div>
                        @error('password')
                            <span class="error invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="input-group mb-3">
                        <input type="password" name="password_confirmation" class="form-control"
                            placeholder="Retype password">
                        <div class="input-group-append">
                            <div class="input-group-text"><span class="fas fa-lock"></span></div>
                        </div>
                    </div>

                    <div class="input-group mb-3">
                        <input type="text" name="nip" class="form-control @error('nip') is-invalid @enderror"
                            value="{{ old('nip') }}" placeholder="NIP">
                        <div class="input-group-append">
                            <div class="input-group-text"><span class="fas fa-user"></span></div>
                        </div>
                        @error('nip')
                            <span class="error invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Address -->
                    <div class="input-group mb-3">
                        <input type="text" name="address" class="form-control @error('address') is-invalid @enderror"
                            value="{{ old('address') }}" placeholder="Address">
                        <div class="input-group-append">
                            <div class="input-group-text"><span class="fas fa-home"></span></div>
                        </div>
                        @error('address')
                            <span class="error invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-8">
                            <div class="icheck-primary">
                                <input type="checkbox" id="agreeTerms" name="terms" value="agree">
                                <label for="agreeTerms">
                                    I agree to the <a href="#">terms</a>
                                </label>
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">Register</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>

                <a href="{{ route('login') }}" class="text-center">I already have a membership</a>
            </div>
            <!-- /.form-box -->
        </div><!-- /.card -->

        <!-- /.form-box -->
    </div>
    <!-- /.register-box -->

    <!-- AdminLTE App -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.0.5/js/adminlte.min.js"
        integrity="sha512-++c7zGcm18AhH83pOIETVReg0dr1Yn8XTRw+0bWSIWAVCAwz1s2PwnSj4z/OOyKlwSXc4RLg3nnjR22q0dhEyA=="
        crossorigin="anonymous"></script>

</body> --}}




</html>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="britech base project" />
    <meta name="description" content="britech base project" />
    <meta name="author" content="britech.id" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <title>Register || {{ env('APP_NAME') }}</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('image/logo/small-icon.png') }}" />

    <!-- font -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,500,500i,600,700,800,900|Poppins:200,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900">
    {{-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Dosis:300,400,500,600,700,800"> --}}

    @include('_website.layouts.css')

    @yield('css')

</head>

<body>


    <div class="wrapper">

        <section class="login white-bg o-hidden scrollbar" tabindex="1">
            <div class="container-fluid p-0">

                <div class="row row-eq-height no-gutter height-100vh">
                    <div class="col-lg-6 parallax" style="background-image: url({{ asset('image/bg_home11.webp') }});">
                        <div class="login-fancy pos-r">
                            <div class="list-unstyled pos-bot pb-30">
                                <img src="{{ asset('image/logo_2.png') }}" height="60">
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-5 position-relative">

                        <div class="vertical-align full-width">
                            <form method="post" action="{{ url('/register') }}">
                                @csrf
                                <input type="hidden" name="username" value="-">

                                <div class="ml-5 mt-3">
                                    <h1 class="text-black text-bold-800">Register</h1>
                                    <p class="mb-20">Daftar, Masukkan Email dan Password Anda.</p>

                                    <div class="pb-50 clearfix white-bg">

                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="section-field mb-20">
                                                    <label class="mb-10" for="name">Nama Lengkap* </label>
                                                    <input id="name"
                                                        class="web form-control @error('name') is-invalid @enderror"
                                                        type="text" placeholder="Masukkan nama" name="name"
                                                        value="{{ old('name') }}">
                                                    @error('name')
                                                        <span class="error invalid-feedback">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-sm-6">
                                                <div class="section-field mb-20">
                                                    <label class="mb-10" for="email">Email* </label>
                                                    <input id="email"
                                                        class="web form-control  @error('email') is-invalid @enderror"
                                                        type="email" placeholder="Masukkan email" name="email">
                                                    @error('email')
                                                        <span class="error invalid-feedback">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-sm-6">
                                                <div class="section-field mb-20">
                                                    <label class="mb-10" for="nip">NIP* </label>
                                                    <input id="nip"
                                                        class="web form-control  @error('nip') is-invalid @enderror"
                                                        type="text" placeholder="Masukkan Nomer Induk Pegawai"
                                                        name="nip">
                                                    @error('nip')
                                                        <span class="error invalid-feedback">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-sm-6">
                                                <div class="section-field mb-20">
                                                    <label class="mb-10" for="password">Password* </label>
                                                    <input id="password"
                                                        class="web form-control  @error('password') is-invalid @enderror"
                                                        type="password" placeholder="Masukkan Password" name="password">
                                                    @error('password')
                                                        <span class="error invalid-feedback">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                        </div>

                                        <button type="submit" class="btn btn-danger">Daftar Sekarang <i
                                                class="fa fa-check"></i></button>

                                        <a href="{{ route('login') }}" class="valid mt-2 ml-4">Saya sudah punya
                                            akun</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    @include('_website.layouts.js')

    @yield('scripts')

</body>

</html>
