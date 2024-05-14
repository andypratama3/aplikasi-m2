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
                                            <span class="content-header-title mb-0 d-inline-block font-medium-4"><b>Keputusan Mutasi</b></span>
                                            <div class="breadcrumbs-top d-inline-block">
                                                <div class="breadcrumb-wrapper">
                                                    @include('layouts.breadcrumb')
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- table --}}
                                

                                <div class="card-body p-0">
                                    <div class="table-responsive">
                                        <table class="table table-hover table-bordered table-striped default" id="pendaftaran-mutasis-table">
                                            <thead>
                                                <tr>
                                                    <th>TGL Masuk Berkas</th>
                                                    <th>Nama Pegawai</th>
                                                    <th>NIP</th>
                                                    <th>Pangkat</th>
                                                    <th>Jabatan Asal</th>
                                                    <th>Perangkat Daerah Asal</th>
                                                    {{-- <th>Unit kerja Asal</th> --}}
                                                    <th>Jabatan Tujuan</th>
                                                    <th>Perangkat Daerah Tujuan</th>
                                                    {{-- <th>Unit kerja Tujuan</th> --}}
                                                    <th>Alasan Mutasi</th>
                                                    <th>Status</th>
                                                    <th colspan="3">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($pendaftaranMutasis as $pendaftaranMutasi)
                                                    <tr>
                                                        <td>{{ $pendaftaranMutasi->tanggal_masuk_berkas?->format('d/m/Y') ?? '' }}</td>
                                                        <td>{{ $pendaftaranMutasi->pegawai->user->name }}</td>
                                                        <td>{{ $pendaftaranMutasi->pegawai->nip }}</td>
                                                        <td>{{ $pendaftaranMutasi->pegawai->pangkat->nama ?? '' }}</td>
                                                        <td>{{ $pendaftaranMutasi->jabatan_asal }}</td>
                                                        <td>{{ $pendaftaranMutasi->asalInstansi->nama ?? '' }}</td>
                                                        {{-- <td>{{ $pendaftaranMutasi->unit_kerja_asal }}</td> --}}
                                                        <td>{{ $pendaftaranMutasi->jabatan_tujuan }}</td>
                                                        <td>{{ $pendaftaranMutasi->tujuanInstansi->nama ?? '' }}</td>
                                                        {{-- <td>{{ $pendaftaranMutasi->unit_kerja_tujuan }}</td> --}}
                                                        <td>{{ $pendaftaranMutasi->alasan_mutasi }}</td>
                                                        <td>
                                                            <a class='btn btn-primary text-white btn-sm d-block mb-1'>
                                                                {{ $pendaftaranMutasi->status }}
                                                            </a>
                                                        </td>
                                                        <td style="width: 120px">
                                                            <div class='btn-group'>
                                                                <a href="{{ route('timeline', [$pendaftaranMutasi->id]) }}" class='btn btn-info btn-sm'>
                                                                    Timeline
                                                                </a>
                                                                @can('pendaftaranMutasis.destroy')
                                                                    {!! Form::open(['route' => ['pendaftaranMutasis.destroy', $pendaftaranMutasi->id], 'method' => 'delete']) !!}
                                                                    {!! Form::button('<i class="fa fa-trash"></i>', [
                                                                        'type' => 'submit',
                                                                        'class' => 'btn btn-danger btn-sm',
                                                                        'onclick' => "return confirm('Are you sure?')",
                                                                    ]) !!}
                                                                    {!! Form::close() !!}
                                                                @endcan
                                                                
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                
                                    <div class="card-footer clearfix">
                                        <div class="float-right">
                                            @include('adminlte-templates::common.paginate', ['records' => $pendaftaranMutasis])
                                        </div>
                                    </div>
                                </div>









                                {{-- akhir table --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

