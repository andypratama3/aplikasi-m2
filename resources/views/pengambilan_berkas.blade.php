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
                    <h2>Slider SOP</h2>
                    <div id="carouselExample" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            <!-- Slide 1 -->
                            <div class="carousel-item active">
                                <img src="{{ asset('sop/slide1.jpg') }}" class="d-block w-100" alt="Slide 1">
                            </div>
                            <!-- Slide 2 -->
                            <div class="carousel-item">
                                <img src="https://placekitten.com/1200/501" class="d-block w-100" alt="Slide 2">
                            </div>
                            <!-- Slide 3 -->
                            <div class="carousel-item">
                                <img src="https://placekitten.com/1200/502" class="d-block w-100" alt="Slide 3">
                            </div>
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
