@extends('_website.layouts.app')
@section('content')
    <section class="slider-parallax business-banner-04 bg-overlay-black-10 parallax" data-jarallax='{"speed": 0.6}' style="background-image: url('{{ asset('image/bg_home.webp') }}');background-position: top">
        <div class="slider-content-middle">
            <div class="container">
                <div class="row">
                    <div class="col-xl-8 col-lg-12">
                        <div class="slider-content">
                            <strong class="d-block text-white">~ BerAKHLAK</strong>
                            <h1 class="text-white text-bold-400">SI Mutasi Pindah <span class="bg-white text-green-metal text-bold-800" style="padding: 0 1rem 0 1rem">SI MUPI</span></h1>
                            <p class="text-white mb-40">BADAN KEPEGAWAIAN DAN PENGEMBANGAN SUMBER DAYA MANUSIA</p>  
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="white-bg page-section-ptb">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3 col-sm-6 border-right pl-0 pl-sm-40">
                    <div class="feature-text p-4">
                        <div class="feature-icon">
                            <span class="ti-desktop text-red"></span>
                        </div>           
                        <div class="feature-info">
                            <h5 class="text-bold-700 text-green-metal"><a href="{{ asset('landing/manualbookSIMUPI1.pdf') }}" target="blank">BUKU PANDUAN</a></h5>
                            <p>Buku Panduan (manual book) merupakah panduan penggunaan aplikasi SIMUPI (silahkan klik tautan di atas)                           
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 border-right pl-0 pl-sm-40">
                    <div class="feature-text p-4">
                        <div class="feature-icon">
                            <span class="ti-headphone text-red"></span>
                        </div>
                        <div class="feature-info">
                            <h5 class="text-bold-700 text-green-metal"><a href="{{ asset('landing/sopmutasi.pdf') }}" target="blank">SOP MUTASI</a></h5>
                            <p> Standar Operasional Prosedur (SOP) Persyaratan Mutasi (Silahkan klik tautan diatas)</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 border-right pl-0 pl-sm-40">
                    <div class="feature-text p-4">
                        <div class="feature-icon">
                            <span class="ti-panel text-red"></span>
                        </div>
                        <div class="menu-links">
                            <h5 class="text-bold-700 text-green-metal"><li><a href="https://sites.google.com/view/bidang-mutasi-promosi/pengumuman/cetak-sk-sk-mutasi">PENGUMUMAN CETAK SK</a></li></h5>
                            <p> Pengumunan informasi terkait pencetakan dan pengunduhan SK (silahkan klik tautan diatas) </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="feature-text p-4">
                        <div class="feature-icon">
                            <span class="fa fa-coffee text-red"></span>
                        </div>
                        <div class="menu-links">
                            <h5 class="text-bold-700 text-green-metal"><li><a href="https://survei.kukarkab.go.id/app/survei/layanan?_token=703188c2697b5c2650a7e0f21200b40518114fd9ee303fd1412b8538edb29201">SURVEI KAMI</a></li></h5>
                            <p> Kuesioner Survei Kepuasan Masyarakat  Bidang Mutasi BKPSDM Survei Kepuasan Masyarakat Terhadap Pelayanan Publik (silahkan klik tautan diatas).
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="awesome-features gray-bg page-section-ptb pos-r">
        <div class="side-background">
            <div class="col-lg-5 img-side img-left d-xs-block d-lg-block d-none">
                <div class="row page-section-pt mt-30">
                <img src="{{ asset('image/bg_home2.webp') }}" alt="">
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row justify-content-end">
                <div class="col-lg-7">
                    <div class="section-title">
                        <h6>Sistem Informasi Mutasi Pindah Instansi </h6>
                        <h2>SI MUPI</h2>
                        <p>Mutasi Pindah Instasi ASN Sejahtera merupakan aksi perubahan dengan menyusun dokumen strategi Perencanaan Mutasi PNS berdasarkan Analisa Jabatan dan Analisa Beban Kerja dalam rangka peningkatan Pelayanan Publik pada Kecamatan dan Kelurahan terjauh dari ibu kota Kabupaten Kutai Kartanegara. 
                            Dalam rangka meningkatkan informasi dan pelayanan PNS di Lingkungan Pemerintah Kabupaten Kutai Kartanegara berbasis layanan digital "selft Service" BKPSDM Kabupaten Kutai Kartanegara memberikan kemudahan dalam mengakses layanan administrasi dan informasi kepegawaian dalam genggaman.Hal ini, tidak hanya memberikan informasi terkait persyaratan dalam administrasi kepegawaian saja, melainkan memberikan layanan tanpa berkas fisik "lesspaper" yang berarti pelayanan dengan tidak menggunakan kertas, sehingga mempermudah kelengkapan dalam mendapatkan pelayanan kepegawaian.
                            </p>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <div class="feature-text text-left mb-30">
                                <div class="feature-icon">
                                    <span class="ti-desktop text-green-metal"></span>
                                </div>
                                <div class="feature-info">
                                    <h5>MELAYANI DENGAN IKLAS</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="feature-text text-left mb-30">
                                <div class="feature-icon">
                                    <span class="ti-headphone text-green-metal"></span>
                                </div>
                                <div class="feature-info">
                                    <h5>BANGGA MELAYANI BANGSA</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="clearfix">
        <div class="page-section-ptb bg-overlay-black-70 parallax pb-150" data-jarallax='{"speed": 0.6}' style="background-image: url('{{ asset('image/bg_home1.webp') }}');">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="section-title text-center">
                            <h2 class="text-white mb-20 mt-50">SI MUPI</h2>
                            <h5 class="text-white fw-20 mb-50">BIDANG MUTASI BKPSDM TAHUN 2024</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="page-section-pb">
            <div class="container">
                <div class="skill-counter">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="section-title">
                                <h6>Contact Person</h6>
                                <h3>HUBUNGI KAMI</h3>
                            </div>
                            <p class="mb-60">ALAMAT : JL. Wolter Monginsidi Komp. Perkantoran Gedung Kembar E Lt. III Kab. Kutai Kartanegara,
                                Telp. (0541) 6666379,
                                Telpon/SMS/WA Khusus Pengaduan : 0811598687,
                                Email : bkpsdm@kukarkab.go.id,
                                KODE POS : 75511</p>
                        </div>
                        <div class="col-md-6 sm-mt-30">
                            <div class="row">
                                <div class="col-sm-6 mb-30">
                                    <div class="counter left-icon counter-small ">
                                        <span class="icon ti-user theme-color" aria-hidden="true"></span>
                                        <span class="timer" data-to="4905" data-speed="10000">4905</span>
                                        <label class="mt-0">Success Projects</label>
                                    </div>
                                </div>
                                <div class="col-sm-6 mb-30">
                                    <div class="counter left-icon counter-small ">
                                        <span class="icon ti-help-alt theme-color" aria-hidden="true"></span>
                                        <span class="timer" data-to="3750" data-speed="10000">3750</span>
                                        <label class="mt-0">Layers Created</label>
                                    </div>
                                </div>
                                <div class="col-sm-6 xs-mb-30">
                                    <div class="counter left-icon counter-small ">
                                        <span class="icon ti-check-box theme-color" aria-hidden="true"></span>
                                        <span class="timer" data-to="4782" data-speed="10000">4782</span>
                                        <label class="mt-0">Team Members</label>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="counter left-icon counter-small ">
                                        <span class="icon ti-face-smile theme-color" aria-hidden="true"></span>
                                        <span class="timer" data-to="3237" data-speed="10000">3237</span>
                                        <label class="mt-0">Coffee Cups</label>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
