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
                                @if ($pendaftaranMutasi->status == 'Proses')
                                    @if ($pendaftaranMutasi->status == 'Proses')
                                        <a href="{{ route('review', [$pendaftaranMutasi->id]) }}"
                                            class='btn btn-dark btn-sm '>
                                            Review
                                        </a>
                                    @endif
                                @endif
                                <a href="{{ route('pendaftaranMutasis.show', [$pendaftaranMutasi->id]) }}"
                                    class='btn btn-success btn-sm'>
                                    <i class="fa fa-eye"></i>
                                </a>
                                {{-- @can('pendaftaranMutasis.edit')
                                    <a href="{{ route('pendaftaranMutasis.edit', [$pendaftaranMutasi->id]) }}"
                                        class='btn btn-warning btn-sm'>
                                        <i class="fa fa-edit"></i>
                                    </a>
                                @endcan --}}
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