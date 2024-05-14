<div class="card-body p-0">
    <div class="table-responsive">
        <table class="table table-hover table-bordered table-striped default" id="pendaftaran-mutasis-table">
            <thead>
                <tr>
                    @role(['admin','super-admin'])
                        <th>Nama Pegawai</th>
                        <th>NIP</th>
                        <th>Pangkat</th>
                    @endrole
                    <th>Asal Instansi</th>
                    <th>Tujuan Instansi</th>
                    <th>Jabatan Asal</th>
                    <th>Jabatan Tujuan</th>
                    <th>Unit kerja Asal</th>
                    <th>Unit kerja Tujuan</th>
                    <th>Alasan Mutasi</th>
                    <th>Status</th>
                    <th colspan="3">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pendaftaranMutasis as $pendaftaranMutasi)
                    <tr>
                        @role(['admin','super-admin'])
                            <td>{{ $pendaftaranMutasi->pegawai->user->name }}</td>
                            <td>{{ $pendaftaranMutasi->pegawai->nip }}</td>
                            <td>{{ $pendaftaranMutasi->pegawai->pangkat->nama }}</td>
                        @endrole
                        <td>{{ $pendaftaranMutasi->asalInstansi->nama }}</td>
                        <td>{{ $pendaftaranMutasi->tujuanInstansi->nama }}</td>
                        <td>{{ $pendaftaranMutasi->jabatan_asal }}</td>
                        <td>{{ $pendaftaranMutasi->jabatan_tujuan }}</td>
                        <td>{{ $pendaftaranMutasi->unit_kerja_asal }}</td>
                        <td>{{ $pendaftaranMutasi->unit_kerja_tujuan }}</td>
                        <td>{{ $pendaftaranMutasi->alasan_mutasi }}</td>
                        <td>
                            <a class='btn btn-primary text-white btn-sm d-block mb-1'>
                                {{ $pendaftaranMutasi->status }}
                            </a>
                            {{-- @if ($pendaftaranMutasi->hasMedia('lampiran'))
                                @foreach ($pendaftaranMutasi->getMedia('lampiran') as $media)
                                    <a class="btn btn-info btn-sm" href="{{ $media->getUrl() }}" target="_blank">Download
                                        SK</a>
                                @endforeach
                            @endif --}}
                        </td>
                        <td style="width: 120px">
                            <div class='btn-group'>
                                <a href="{{ route('pendaftaranMutasis.show', [$pendaftaranMutasi->id]) }}"
                                    class='btn btn-light btn-sm'>
                                    <i class="fa fa-eye"></i>
                                </a>
                                <a href="{{ route('timeline', [$pendaftaranMutasi->id]) }}" class='btn btn-info btn-sm'>
                                    Timeline
                                </a>
                                {{-- @if ($pendaftaranMutasi->status == 'Draft') --}}
                                    @can('pendaftaranMutasis.edit')
                                        <a href="{{ route('pendaftaranMutasis.edit', [$pendaftaranMutasi->id]) }}"
                                            class='btn btn-warning btn-sm'>
                                            <i class="fa fa-edit"></i>
                                        </a>
                                    @endcan
                                    @can('pendaftaranMutasis.destroy')
                                        {!! Form::open(['route' => ['pendaftaranMutasis.destroy', $pendaftaranMutasi->id], 'method' => 'delete']) !!}
                                        {!! Form::button('<i class="fa fa-trash"></i>', [
                                            'type' => 'submit',
                                            'class' => 'btn btn-danger btn-sm',
                                            'onclick' => "return confirm('Are you sure?')",
                                        ]) !!}
                                        {!! Form::close() !!}
                                    @endcan
                                {{-- @endif --}}
                                {{-- hanya admin dan statusnya lagi proses baru boleh di review --}}
                                @if (Auth::user()->hasRole(['admin', 'super-admin']) && $pendaftaranMutasi->status == 'Proses')
                                    @if ($pendaftaranMutasi->status == 'Proses')
                                        <a href="{{ route('review', [$pendaftaranMutasi->id]) }}"
                                            class='btn btn-dark btn-sm '>
                                            Review
                                        </a>
                                    @endif
                                @endif
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
<div class="card-body p-0">
    <div class="table-responsive">
        <table class="table table-hover table-bordered table-striped default" id="pendaftaran-mutasis-table">
            <thead>
                <tr>
                    @role(['admin','super-admin'])
                        <th>Nama Pegawai</th>
                        <th>NIP</th>
                        <th>Pangkat</th>
                    @endrole
                    <th>Asal Instansi</th>
                    <th>Tujuan Instansi</th>
                    <th>Jabatan Asal</th>
                    <th>Jabatan Tujuan</th>
                    <th>Unit kerja Asal</th>
                    <th>Unit kerja Tujuan</th>
                    <th>Alasan Mutasi</th>
                    <th>Status</th>
                    <th colspan="3">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pendaftaranMutasis as $pendaftaranMutasi)
                    <tr>
                        @role(['admin','super-admin'])
                            <td>{{ $pendaftaranMutasi->pegawai->user->name }}</td>
                            <td>{{ $pendaftaranMutasi->pegawai->nip }}</td>
                            <td>{{ $pendaftaranMutasi->pegawai->pangkat->nama }}</td>
                        @endrole
                        <td>{{ $pendaftaranMutasi->asalInstansi->nama }}</td>
                        <td>{{ $pendaftaranMutasi->tujuanInstansi->nama }}</td>
                        <td>{{ $pendaftaranMutasi->jabatan_asal }}</td>
                        <td>{{ $pendaftaranMutasi->jabatan_tujuan }}</td>
                        <td>{{ $pendaftaranMutasi->unit_kerja_asal }}</td>
                        <td>{{ $pendaftaranMutasi->unit_kerja_tujuan }}</td>
                        <td>{{ $pendaftaranMutasi->alasan_mutasi }}</td>
                        <td>
                            <a class='btn btn-primary text-white btn-sm d-block mb-1'>
                                {{ $pendaftaranMutasi->status }}
                            </a>
                            {{-- @if ($pendaftaranMutasi->hasMedia('lampiran'))
                                @foreach ($pendaftaranMutasi->getMedia('lampiran') as $media)
                                    <a class="btn btn-info btn-sm" href="{{ $media->getUrl() }}" target="_blank">Download
                                        SK</a>
                                @endforeach
                            @endif --}}
                        </td>
                        <td style="width: 120px">
                            <div class='btn-group'>
                                <a href="{{ route('pendaftaranMutasis.show', [$pendaftaranMutasi->id]) }}"
                                    class='btn btn-light btn-sm'>
                                    <i class="fa fa-eye"></i>
                                </a>
                                <a href="{{ route('timeline', [$pendaftaranMutasi->id]) }}" class='btn btn-info btn-sm'>
                                    Timeline
                                </a>
                                {{-- @if ($pendaftaranMutasi->status == 'Draft') --}}
                                    @can('pendaftaranMutasis.edit')
                                        <a href="{{ route('pendaftaranMutasis.edit', [$pendaftaranMutasi->id]) }}"
                                            class='btn btn-warning btn-sm'>
                                            <i class="fa fa-edit"></i>
                                        </a>
                                    @endcan
                                    @can('pendaftaranMutasis.destroy')
                                        {!! Form::open(['route' => ['pendaftaranMutasis.destroy', $pendaftaranMutasi->id], 'method' => 'delete']) !!}
                                        {!! Form::button('<i class="fa fa-trash"></i>', [
                                            'type' => 'submit',
                                            'class' => 'btn btn-danger btn-sm',
                                            'onclick' => "return confirm('Are you sure?')",
                                        ]) !!}
                                        {!! Form::close() !!}
                                    @endcan
                                {{-- @endif --}}
                                {{-- hanya admin dan statusnya lagi proses baru boleh di review --}}
                                @if (Auth::user()->hasRole(['admin', 'super-admin']) && $pendaftaranMutasi->status == 'Proses')
                                    @if ($pendaftaranMutasi->status == 'Proses')
                                        <a href="{{ route('review', [$pendaftaranMutasi->id]) }}"
                                            class='btn btn-dark btn-sm '>
                                            Review
                                        </a>
                                    @endif
                                @endif
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
