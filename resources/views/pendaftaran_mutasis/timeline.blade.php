@extends('layouts.app')

@section('content')
    {{-- css --}}

    <head>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap');

            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
                font-family: "Poppins", sans-serif;
            }

            html {
                scroll-behavior: smooth;
            }

            body {
                background: #ff7979;
            }

            ::selection {
                color: #fff;
                background: #ff7979;
            }

            .wrapper {
                max-width: 1080px;
                margin: 50px auto;
                padding: 0 20px;
                position: relative;
            }

            .wrapper .center-line {
                position: absolute;
                height: 100%;
                width: 4px;
                background: #000000;
                left: 50%;
                top: 20px;
                transform: translateX(-50%);
            }

            .wrapper .row {
                display: flex;
            }

            .wrapper .row-1 {
                justify-content: flex-start;
            }

            .wrapper .row-2 {
                justify-content: flex-end;
            }

            .wrapper .row section {
                background: #fff;
                border-radius: 5px;
                width: calc(50% - 40px);
                padding: 20px;
                position: relative;
            }

            .wrapper .row section::before {
                position: absolute;
                content: "";
                height: 15px;
                width: 15px;
                background: #fff;
                top: 28px;
                z-index: -1;
                transform: rotate(45deg);
            }

            .row-1 section::before {
                right: -7px;
            }

            .row-2 section::before {
                left: -7px;
            }

            .row section .icon,
            .center-line .scroll-icon {
                position: absolute;
                background: #f2f2f2;
                height: 40px;
                width: 40px;
                text-align: center;
                line-height: 40px;
                border-radius: 50%;
                color: #ff7979;
                font-size: 17px;
                box-shadow: 0 0 0 4px #fff, inset 0 2px 0 rgba(0, 0, 0, 0.08), 0 3px 0 4px rgba(0, 0, 0, 0.05);
            }

            .center-line .scroll-icon {
                bottom: 0px;
                left: 50%;
                font-size: 25px;
                transform: translateX(-50%);
            }

            .row-1 section .icon {
                top: 15px;
                right: -60px;
            }

            .row-2 section .icon {
                top: 15px;
                left: -60px;
            }

            .row section .details,
            .row section .bottom {
                display: flex;
                align-items: center;
                justify-content: space-between;
            }

            .row section .details .title {
                font-size: 22px;
                font-weight: 600;
            }

            .row section p {
                margin: 10px 0 17px 0;
            }

            .row section .bottom a {
                text-decoration: none;
                background: #ff7979;
                color: #fff;
                padding: 7px 15px;
                border-radius: 5px;
                /* font-size: 17px; */
                font-weight: 400;
                transition: all 0.3s ease;
            }

            .row section .bottom a:hover {
                transform: scale(0.97);
            }

            @media(max-width: 790px) {
                .wrapper .center-line {
                    left: 40px;
                }

                .wrapper .row {
                    margin: 30px 0 3px 60px;
                }

                .wrapper .row section {
                    width: 100%;
                }

                .row-1 section::before {
                    left: -7px;
                }

                .row-1 section .icon {
                    left: -60px;
                }
            }

            @media(max-width: 440px) {

                .wrapper .center-line,
                .row section::before,
                .row section .icon {
                    display: none;
                }

                .wrapper .row {
                    margin: 10px 0;
                }
            }
        </style>
    </head>
    <div class="content-body">
        <section id="horizontal-form-layouts">
            <div class="row">
                <div class="col-md-12">
                    <div class="card overflow-hidden">
                        <div class="card-content">
                            <div class="media align-items-stretch">
                                <div class="bg-green p-2 media-middle">
                                    <i class="fa fa-pencil-square font-large-2 text-white"></i>
                                </div>
                                <div class="media-body p-1">
                                    <span class="green font-medium-5">Input Pendaftaran Mutasi</span><br>
                                    <span style="margin-top: -5px">Membuat Pendaftaran Mutasi Baru</span>
                                    @include('flash::message')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    @include('adminlte-templates::common.errors')
                    <div class="card">
                        <div class="card-content collpase show">
                            <div class="card-body">
                                <div class="wrapper">
                                    <div class="center-line">
                                        <a href="#" class="scroll-icon"><i class="fas fa-caret-up"></i></a>
                                    </div>
                                    {{-- timeline --}}
                                    @foreach ($pendaftaranMutasi->pendaftaranMutasiStatuses as $index => $pendaftaranMutasiStatuse)
                                        <div
                                            class="row 
                                        @if ($index % 2 == 0) 
                                            row-1 
                                        @else
                                            row-2 
                                        @endif
                                        ">
                                            <section>
                                                <i class="icon fas fa-home"></i>
                                                <div class="details">
                                                    <span
                                                        class="title">{{ $pendaftaranMutasiStatuse->statusMutasi->nama }}</span>
                                                        <span>{{ $pendaftaranMutasiStatuse->created_at->format('d M Y H:i') }}</span>
                                                </div>
                                                <p>{{ $pendaftaranMutasiStatuse->message }}.</p>
                                                <div class="bottom">
                                                    {{-- <a href="#">Read more</a> --}}
                                                    <i>- {{ $pendaftaranMutasiStatuse->approvedBy->name }}</i>
                                                </div>
                                                {{-- @if ($pendaftaranMutasi->hasMedia('lampiran') && ($pendaftaranMutasiStatuse->statusMutasi->nama == 'Disetujui' || $pendaftaranMutasiStatuse->statusMutasi->nama == 'Ditolak'))
                                                    @foreach ($pendaftaranMutasi->getMedia('lampiran') as $media)
                                                        <a class="btn btn-info btn-sm" href="{{ $media->getUrl() }}" target="_blank">Download
                                                            SK</a>
                                                    @endforeach
                                                @endif --}}
                                                @if ($pendaftaranMutasiStatuse->hasMedia('lampiran') )
                                                @foreach ($pendaftaranMutasiStatuse->getMedia('lampiran') as $media)
                                                    <a class="btn btn-info btn-sm mt-1" href="{{ $media->getUrl() }}" target="_blank">Download Berkas</a>
                                                @endforeach
                                                @endif
                                            </section>
                                        </div>
                                    @endforeach

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
