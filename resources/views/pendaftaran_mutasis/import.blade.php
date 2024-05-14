@extends('layouts.app')

@section('content')
    <div class="content-body">
        <div class="row">
            <div class="col-12">
                @include('flash::message')
                <div class="clearfix"></div>
                <div class="card">
                    <div class="border-left-green border-left-6 box-shadow-1 rounded">
                        <div class="card-content">
                            <div class="card-body card-dashboard">
                                <div class="row">
                                    <div class="col-10 media-body mb-2">
                                        <div class="content-header-left breadcrumb-new">
                                            <span class="content-header-title mb-0 d-inline-block font-medium-4"><b>Rekap Absensi Import</b></span>
                                            <div class="breadcrumbs-top d-inline-block">
                                                <div class="breadcrumb-wrapper">
                                                    @include('layouts.breadcrumb')
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    @include('adminlte-templates::common.errors')
                                    @include('flash::message')
                                </div>
                                <form action="{{ route('pendaftaranMutasis.import') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="col-md-6 ml-2">
                                        <label for="tahun">File:</label>
                                        <input type="file" name="file" class="form-control">
                                    </div>
                                    
                                    <div class="form-actions center">
                                        <button class="btn btn-green"><i class="ft-upload"></i> Import Data</button>
                                    </div>  
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
