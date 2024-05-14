<header id="header" class="header {{ Request::is('/') ? 'default fullWidth' : 'light' }}"
    style="background-color: rgba(10,22,10,0.1)">
    <div class="menu">
        <!-- menu start -->
        <nav id="menu" class="mega-menu">
            <!-- menu list items container -->
            <section class="menu-list-items">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <!-- menu logo -->
                            <ul class="menu-logo">
                                <li>
                                    <a href="{{ '/' }}"><img id="logo_img"
                                            src="{{ asset('image/logo_2.png') }}" alt="logo"> </a>
                                </li>
                            </ul>
                            <!-- menu links -->
                            <div class="menu-bar">
                                <ul class="menu-links">
                                    <li><a href="https://bkpsdm.kukarkab.go.id/">Beranda</a></li>
                                    <li><a href="https://sites.google.com/view/bidang-mutasi-promosi/pengumuman/info-kepangkatan-pns?authuser=0">Informasi</a></li>
                                    @if (Route::has('login'))
                                        @auth
                                            {{-- jika dia admin kirim ke home --}}
                                            @if (Auth::user()->hasRole(['admin', 'super-admin']))
                                                <li><a href="{{ '/home' }}" class="btn btn-warning p-1 text-dark"><i
                                                            class="ti-dashboard"></i> Dashboard</a></li>
                                            @else
                                                <li><a href="{{ '/pendaftaranMutasis' }}"
                                                        class="btn btn-warning p-1 text-white"><i class="ti-dashboard"></i>
                                                        Dashboard</a></li>
                                            @endif
                                        @endauth

                                        @guest
                                            <li><a href="{{ 'login' }}" class="btn btn-danger p-1 text-white"><i
                                                        class="ti-key"></i> Masuk</a></li>

                                            @if (Route::has('register'))
                                                <li><a href="{{ 'register' }}"
                                                        class="ml-2 btn btn-warning p-1 text-white"><i class="ti-pencil"></i>
                                                        Daftar</a></li>
                                            @endif
                                        @endguest
                                    @endif


                                    {{-- <li><a href="javascript:void(0)"  data-toggle="modal" data-target=".bd-example-modal-lg" class="btn btn-warning border-0 text-green-metal-bg-dark text-white p-1 ml-2"><i class="fa fa-search pl-1"></i> Pencarian</a></li> --}}
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </nav>
        <!-- menu end -->
    </div>
</header>

<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-title" id="exampleModalLongTitle">
                    <div class="section-title mb-10">
                        <h6>PENCARIAN ANDA</h6>
                    </div>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input class="web form-control" type="text" placeholder="Apa yang anda cari?" name="web">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Pencarian</button>
            </div>
        </div>
    </div>
</div>
