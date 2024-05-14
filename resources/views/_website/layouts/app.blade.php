<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="Mutasi, BKPSDM, KUKAR, PNS, Pegawai Negeri Sipil">
    <meta name="description" content="Selamat datang di situs Mutasi BKPSDM KUKAR. Sistem Informasi tentang mutasi Pegawai Negeri Sipil (PNS) di Badan Kepegawaian dan Pengembangan Sumber Daya Manusia Kabupaten Kutai Kartanegara.">
    <meta name="author" content="britech.id" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <title>Mutasi BKPSDM KUKAR</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('image/logo.png') }}" />

    <!-- font -->
    <link  rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,500,500i,600,700,800,900|Poppins:200,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Dosis:300,400,500,600,700,800">

    @include('_website.layouts.css')

    @yield('css')

</head>

<body>
<div class="wrapper">

{{--    <div id="pre-loader">--}}
{{--        <img src="master/asset-web/images/pre-loader/loader-01.svg" alt="">--}}
{{--    </div>--}}

    @include('_website.layouts.header')

    @yield('content')

    @include('_website.layouts.footer')
</div>
     @include("_website.layouts.js")
</body>
</html>
