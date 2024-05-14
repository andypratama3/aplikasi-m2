@extends('layouts.app')
@section('content')
    <div class="content-body">
        <div class="row">
            <div class="col-12">
                @include('flash::message')
                <div class="clearfix"></div>
                <div class="card">
                    <div class="border-left-pink border-left-6 box-shadow-1 rounded">
                        <div class="card-content ">
                            <div class="card-body card-dashboard">
                                <div class="row">
                                    <div class="col-10 media-body mb-2">
                                        <div class="content-header-left breadcrumb-new">
                                            <span class="content-header-title mb-0 d-inline-block font-medium-4"><b>Pendaftaran Mutasi</b></span>
                                            <div class="breadcrumbs-top d-inline-block">
                                                <div class="breadcrumb-wrapper">
                                                    @role(['admin', 'super-admin'])
                                                    @can('pendaftaranMutasis.index')
                                                        <a href="{{ route('pendaftaranMutasis.contohImport')}}" class="btn btn-sm btn-primary">Contoh Data Import </a>
                                                    @endcan
                                                    @can('pendaftaranMutasis.index')
                                                        <a href="{{ route('pendaftaranMutasis.export')}}" class="btn btn-sm btn-dark">Export Data </a>
                                                    @endcan
                                                    @can('pendaftaranMutasis.index')
                                                        <a href="{{ route('pendaftaranMutasis.importView')}}" class="btn btn-sm btn-success">Import Data </a>
                                                    @endcan
                                                    @else
                                                        @include('layouts.breadcrumb')
                                                    @endrole
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-2 text-center">
                                        @can('pendaftaranMutasis.create')
                                        <a href="{{ route('pendaftaranMutasis.create') }}" class="btn btn-sm btn-green">Daftar Mutasi
                                        </a>
                                        @endcan
                                    </div>
                                </div>
                                @role('pegawai')
                                    @include('pendaftaran_mutasis.table_user')
                                @else
                                    @include('pendaftaran_mutasis.table_admin')
                                @endrole
                                {{-- @include('pendaftaran_mutasis.table') --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

