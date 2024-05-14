<div class="card-body p-0">
    <div class="table-responsive">
        <table class="table table-hover table-bordered table-striped default" id="pegawais-table">
            <thead>
                <tr>
                    <th>Nama</th>
                    @can('pegawais.create')
                        <th>role </th>
                    @endcan
                    <th>NIP</th>
                    <th>Tanggal Masuk</th>
                    <th>Date Of Birth</th>
                    <th>Place Of Birth</th>
                    <th>Pangkat</th>
                    <th colspan="3">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pegawais as $pegawai)
                    <tr>
                        <td>{{ $pegawai->user->name }}</td>
                        @can('pegawais.create')
                            <td>{{ $pegawai->user?->roles?->first()?->name ?? 'NA' }}</td>
                        @endcan
                        <td>{{ $pegawai->nip }}</td>
                        <td>{{ $pegawai->tanggal_masuk?->format('d/m/Y') ?? '' }}</td>
                        <td>{{ $pegawai->date_of_birth?->format('d/m/Y') ?? '' }}</td>
                        <td>{{ $pegawai->place_of_birth }}</td>
                        <td>{{ $pegawai->pangkat->nama ?? '' }}</td>
                        <td style="width: 120px">       
                            <div class='btn-group'>
                                <a href="{{ route('pegawais.show', [$pegawai->id]) }}" class='btn btn-info btn-sm'>
                                    <i class="fa fa-eye"></i>
                                </a>
                                @can('pegawais.edit')
                                    <a href="{{ route('pegawais.edit', [$pegawai->id]) }}" class='btn btn-warning btn-sm'>
                                        <i class="fa fa-edit"></i>
                                    </a>
                                @endcan
                                @if ($pegawai->user->roles->first()->name != 'admin' && $pegawai->user->roles->first()->name != 'super-admin')
                                    @can('pegawais.destroy')
                                        {!! Form::open(['route' => ['pegawais.destroy', $pegawai->id], 'method' => 'delete']) !!}
                                        {!! Form::button('<i class="fa fa-trash"></i>', [
                                            'type' => 'submit',
                                            'class' => 'btn btn-danger btn-sm',
                                            'onclick' => "return confirm('Are you sure?')",
                                        ]) !!}
                                        {!! Form::close() !!}
                                    @endcan
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
            @include('adminlte-templates::common.paginate', ['records' => $pegawais])
        </div>
    </div>
</div>
