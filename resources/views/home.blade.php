@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-4 col-lg-12 col-md-12">
                <div class="card bg-amber">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="media">
                                <div class="media-left media-middle">
                                    <i class="fa fa-trophy white font-large-2 float-left"></i>
                                </div>
                                <div class="media-body white text-right">
                                    <h3 class="white">{{ $jumlahMutasiDisetujui }}</h3>
                                    <span>Mutasi Yang DIsetujui</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card" data-appear="appear" data-animation="animation">
                    <div class="card-content">
                        <div class="card-body text-center">
                            <div class="p-1 text-center">
                                <div>
                                    <h3 class="font-large-1 grey darken-4 text-bold-400">{{ $jumlahPns }}</h3>
                                    <span class="font-small-3 grey darken-4">Total PNS Terdaftar</span>
                                </div>
                                <div class="card-content overflow-hidden">
                                    <div id="morris-comments" class="height-75"
                                        style="position: relative; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);"><svg
                                            height="75" version="1.1" width="232.667" xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink"
                                            style="overflow: hidden; position: relative; left: -0.791687px; top: -0.65625px;">
                                            <desc style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">Created with
                                                Raphaël 2.2.0</desc>
                                            <defs style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></defs>
                                            <path fill="#5cc8ad" stroke="none"
                                                d="M25,31.25C28.25999885119377,29.6875,34.77999655358131,25.15625,38.039995404775084,25C41.299994255968855,24.84375,47.8199919583564,28.59375,51.07999080955017,30C54.33998966074394,31.40625,60.85998736313148,35.93792749658003,64.11998621432525,36.25C67.38891656922092,36.56292749658003,73.92677727901227,32.18707114088647,77.19570763390794,32.5C80.45567805728322,32.81207114088647,86.97561890403377,38.593750681268034,90.23558932740904,38.75C93.49558817860282,38.906250681268034,100.01558588099036,33.90625,103.27558473218413,33.75C106.5355835833779,33.59375,113.05558128576544,37.18792749658003,116.31558013695921,37.5C119.58451049185489,37.81292749658003,126.12237120164625,35.624145006839946,129.39130155654192,36.25C132.65130040773568,36.874145006839946,139.17129811012325,41.25,142.431296961317,42.5C145.69129581251076,43.75,152.2112935148983,46.71875,155.47129236609206,46.25C158.73129121728584,45.78125,165.25128891967336,38.906036251709985,168.51128777086714,38.75C171.78021812576281,38.593536251709985,178.31807883555416,45.46939124487004,181.58700919044983,45C184.84700804164362,44.53189124487004,191.36700574403113,36.5625,194.62700459522492,35C197.8870034464187,33.4375,204.40700114880622,33.125,207.667,32.5L207.667,50L25,50Z"
                                                fill-opacity="0.1"
                                                style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 0.1;">
                                            </path>
                                            <path fill="none" stroke="#37bc9b"
                                                d="M25,31.25C28.25999885119377,29.6875,34.77999655358131,25.15625,38.039995404775084,25C41.299994255968855,24.84375,47.8199919583564,28.59375,51.07999080955017,30C54.33998966074394,31.40625,60.85998736313148,35.93792749658003,64.11998621432525,36.25C67.38891656922092,36.56292749658003,73.92677727901227,32.18707114088647,77.19570763390794,32.5C80.45567805728322,32.81207114088647,86.97561890403377,38.593750681268034,90.23558932740904,38.75C93.49558817860282,38.906250681268034,100.01558588099036,33.90625,103.27558473218413,33.75C106.5355835833779,33.59375,113.05558128576544,37.18792749658003,116.31558013695921,37.5C119.58451049185489,37.81292749658003,126.12237120164625,35.624145006839946,129.39130155654192,36.25C132.65130040773568,36.874145006839946,139.17129811012325,41.25,142.431296961317,42.5C145.69129581251076,43.75,152.2112935148983,46.71875,155.47129236609206,46.25C158.73129121728584,45.78125,165.25128891967336,38.906036251709985,168.51128777086714,38.75C171.78021812576281,38.593536251709985,178.31807883555416,45.46939124487004,181.58700919044983,45C184.84700804164362,44.53189124487004,191.36700574403113,36.5625,194.62700459522492,35C197.8870034464187,33.4375,204.40700114880622,33.125,207.667,32.5"
                                                stroke-width="2" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">
                                            </path>
                                            <circle cx="25" cy="31.25" r="0" fill="#37bc9b" stroke="#ffffff"
                                                stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">
                                            </circle>
                                            <circle cx="38.039995404775084" cy="25" r="0" fill="#37bc9b"
                                                stroke="#ffffff" stroke-width="1"
                                                style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle>
                                            <circle cx="51.07999080955017" cy="30" r="0" fill="#37bc9b"
                                                stroke="#ffffff" stroke-width="1"
                                                style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle>
                                            <circle cx="64.11998621432525" cy="36.25" r="0" fill="#37bc9b"
                                                stroke="#ffffff" stroke-width="1"
                                                style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle>
                                            <circle cx="77.19570763390794" cy="32.5" r="0" fill="#37bc9b"
                                                stroke="#ffffff" stroke-width="1"
                                                style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle>
                                            <circle cx="90.23558932740904" cy="38.75" r="0" fill="#37bc9b"
                                                stroke="#ffffff" stroke-width="1"
                                                style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle>
                                            <circle cx="103.27558473218413" cy="33.75" r="0" fill="#37bc9b"
                                                stroke="#ffffff" stroke-width="1"
                                                style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle>
                                            <circle cx="116.31558013695921" cy="37.5" r="0" fill="#37bc9b"
                                                stroke="#ffffff" stroke-width="1"
                                                style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle>
                                            <circle cx="129.39130155654192" cy="36.25" r="0" fill="#37bc9b"
                                                stroke="#ffffff" stroke-width="1"
                                                style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle>
                                            <circle cx="142.431296961317" cy="42.5" r="0" fill="#37bc9b"
                                                stroke="#ffffff" stroke-width="1"
                                                style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle>
                                            <circle cx="155.47129236609206" cy="46.25" r="0" fill="#37bc9b"
                                                stroke="#ffffff" stroke-width="1"
                                                style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle>
                                            <circle cx="168.51128777086714" cy="38.75" r="0" fill="#37bc9b"
                                                stroke="#ffffff" stroke-width="1"
                                                style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle>
                                            <circle cx="181.58700919044983" cy="45" r="0" fill="#37bc9b"
                                                stroke="#ffffff" stroke-width="1"
                                                style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle>
                                            <circle cx="194.62700459522492" cy="35" r="0" fill="#37bc9b"
                                                stroke="#ffffff" stroke-width="1"
                                                style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle>
                                            <circle cx="207.667" cy="32.5" r="0" fill="#37bc9b" stroke="#ffffff"
                                                stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">
                                            </circle>
                                        </svg>
                                        <div class="morris-hover morris-default-style" style="display: none;"></div>
                                    </div>
                                    <ul class="list-inline clearfix mb-0">
                                        <li class="border-right-grey border-right-lighten-2 pr-2">
                                            <h3 class="blue text-bold-400">{{ $jumlahLaki }}</h3>
                                            <span class="font-small-3 grey darken-4"><i class="ft-chevron-up success"></i>
                                                Laki-laki</span>
                                        </li>
                                        <li class="pl-2">
                                            <h3 class="red text-bold-400">{{ $jumlahWanita }}</h3>
                                            <span class="font-small-3 grey darken-4"><i
                                                    class="ft-chevron-down success"></i> Perempuan</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-6 col-md-12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body text-center">
                            <div class="card mt-1 mb-1">
                                <span class="green darken-1">Selesai Diproses</span>
                                <h3 class="font-large-2 grey darken-4 text-bold-200">
                                    {{ $jumlahMutasiDisetujui + $jumlahMutasiDitolak }}</h3>
                            </div>
                            <div class="card-content">
                                <div class="height-150">
                                    {{-- <canvas id="simple-doughnut-chart-dua"></canvas> --}}
                                    <canvas id ="simple-doughnut-chart-dua" width="225" height="225"
                                        style="width: 150px; height: 150px;"></canvas>
                                    <i class="knob-center-icon ft-trending-up"
                                        style="width: 79px; height: 50px; position: absolute; vertical-align: middle; margin-top: 50px; margin-left: -114px; border: 0px; background: none; font: normal 30px Arial; text-align: center; color: rgb(225, 225, 225); padding: 0px; appearance: none;font-size: 50px;"></i>
                                </div>

                                <ul class="list-inline clearfix mt-2 mb-0">
                                    <li class="border-right-grey border-right-lighten-2 pr-2">
                                        <h2 class="grey darken-4 text-bold-400">{{ $jumlahMutasiDisetujui }}</h2>
                                        <span class="blue">Disetujui</span>
                                    </li>
                                    <li class="pl-2">
                                        <h2 class="grey darken-4 text-bold-400">{{ $jumlahMutasiDitolak }}</h2>
                                        <span class="red">Ditolak</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-12 col-md-12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="media">
                                <div class="media-body text-left">
                                    <h3 class="grey darken-4">{{ $jumlahMutasiDraft }}</h3>
                                    <span class="grey darken-4">Status Draft</span>
                                </div>
                                <div class="media-right media-middle">
                                    <i class="fa fa-users grey darken-4 font-large-2 float-right"></i>
                                </div>
                            </div>
                            <div class="progress mt-1 mb-0" style="height: 7px;">
                                <div class="progress-bar bg-grey darken-4" role="progressbar"
                                    style="width: {{ $jumlahPns }}%" aria-valuenow="80" aria-valuemin="0"
                                    aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="media">
                                <div class="media-body text-left">
                                    <h3 class="amber">{{ $jumlahMutasiDiproses }}</h3>
                                    <span class="grey darken-4">Menunggu</span>
                                </div>
                                <div class="media-right media-middle">
                                    <i class="fa fa-cube amber font-large-2 float-right"></i>
                                </div>
                            </div>
                            {{-- <div class="progress mt-1 mb-0" style="height: 7px;">
                                <div class="progress-bar bg-amber" role="progressbar" style="width: 35%" aria-valuenow="35" aria-valuemin="0" aria-valuemax="100"></div>
                            </div> --}}
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="media">
                                <div class="media-body text-left">
                                    <h3 class="blue">{{ $tujuanInstansiPendidikan }}</h3>
                                    <span class="blue">JF Pendidikan</span>
                                </div>
                                <div class="media-body text-left">
                                    <h3 class="blue">{{ $tujuanInstansiKesehatan }}</h3>
                                    <span class="blue">JF Kesehatan</span>
                                </div>
                                <div class="media-body text-left">
                                    <h3 class="blue">{{ $tujuanInstansiTeknis }}</h3>
                                    <span class="blue">Umum</span>
                                </div>
                                {{-- <div class="media-right media-middle">
                                    <i class="fa fa-user-plus green font-large-2 float-right"></i>
                                </div> --}}
                            </div>
                            {{-- <div class="progress mt-1 mb-0" style="height: 7px;">
                                <div class="progress-bar bg-green" role="progressbar" style="width: 35%" aria-valuenow="35" aria-valuemin="0" aria-valuemax="100"></div>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
