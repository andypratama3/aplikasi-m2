@extends('layouts.app')
@section('content')
    <div class="content-body">
        <div class="row">
            <div class="col-12">

                <!-- Jumbotron -->
                <div class="jumbotron text-center">
                    <h1>SOP PELAYANAN Mutasi</h1>
                    <p>Standar Operasional Prosedur Pelayanan Mutasi BKPSDM Kutai Kartanegara.</p>
                </div>

                <!-- Slide Section -->
                <div id="slide-section" class="container mt-4 mb-5">
                    <div id="carouselExample" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            {{-- perulangan slideSops pakai spatie--}}
                            @foreach ($slideSops as $slideSop)
                                <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                    <img src="{{ $slideSop->getFirstMediaUrl('gambar_slide') }}" class="d-block w-100"
                                        alt="{{ $slideSop->description }}">
                                    {{-- <div class="carousel-caption d-none d-md-block">
                                        <h5>{{ $slideSop->title }}</h5>
                                        <p>{{ $slideSop->description }}</p>
                                    </div> --}}
                                </div>
                            @endforeach
                        </div>
                        <a class="carousel-control-prev" href="#carouselExample" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExample" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and Popper.js -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
@endsection
