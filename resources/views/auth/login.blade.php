<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="keywords" content="britech base project" />
<meta name="description" content="britech base project" />
<meta name="author" content="britech.id" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
<title>Login || {{ env('APP_NAME') }}</title>

<!-- Favicon -->
<link rel="shortcut icon" href="{{ asset('image/logo/small-icon.png') }}" />

<!-- font -->
<link  rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,500,500i,600,700,800,900|Poppins:200,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900">
{{--<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Dosis:300,400,500,600,700,800">--}}

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
                            <img src="{{asset('image/logo_2.png')}}" height="60">
                        </div>
                    </div>
                </div>

                <div class="col-lg-5 position-relative">

                    <div class="vertical-align full-width">
                        <form method="post" action="{{ url('/login') }}">
                            @csrf

                            <div class="login-14">
                                <h1 class="text-black text-bold-800">Login</h1>
                                <p class="mb-30">Login, Masukkan Email dan Password Anda.</p>
                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror

                                @error('password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror

                                <div class="pb-50 clearfix white-bg">

                                    <div class="section-field mb-20">
                                        <label class="mb-10" for="Email">Email* </label>
                                        <input id="email" class="web form-control @error('email') is-invalid @enderror" type="text" placeholder="Masukkan Email" name="email"  value="{{ old('email') }}">
                                    </div>


                                    <div class="section-field mb-20">
                                        <label class="mb-10" for="password">Password* </label>
                                        <input id="password" class="Password form-control  @error('password') is-invalid @enderror" type="password" placeholder="Password" name="password">
                                    </div>

                                    <div class="section-field">
                                        <div class="remember-checkbox mb-30">
                                            <input type="checkbox" class="form-control" name="two" id="two">
                                            <label class="mb-2" for="two"> Remember me</label>
                                            <!-- <a href="password-recovery.html" class="float-end">Forgot Password?</a> -->
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-success">Login Sekarang <i class="fa fa-check"></i></button>
                                    <a href="{{ route('register') }}" class="valid mt-2 ml-4 text-danger">Belum Punya Akun?</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

     @include("_website.layouts.js")

     @yield("scripts")

</body>
</html>

