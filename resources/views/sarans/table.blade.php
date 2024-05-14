<div class="card-body p-0">
    <div class="table-responsive">
        <table class="table table-hover table-bordered table-striped default" id="sarans-table">
            <thead>
            <tr>
                @role(['admin', 'super-admin'])
                <th>Pegawai</th>
                <th>NIP</th>
                @endrole
                <th>Judul / Prihal</th>
                <th colspan="3">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($sarans as $saran)
                <tr>
                    @role(['admin', 'super-admin'])
                    <td>{{ $saran->pegawai->user->name }}</td>
                    <td>{{ $saran->pegawai->nip }}</td>
                    @endrole
                    <td>{{ $saran->judul }}</td>
                    <td  style="width: 120px">
                        <div class='btn-group'>
                            <a href="{{ route('sarans.show', [$saran->id]) }}"
                               class='btn btn-info btn-sm'>
                                <i class="fa fa-eye"></i>
                            </a>
                            @can('sarans.edit')
                            <a href="{{ route('sarans.edit', [$saran->id]) }}"
                                   class='btn btn-warning btn-sm'>
                                    <i class="fa fa-edit"></i>
                                </a>
                            @endcan
                            @can('sarans.destroy')
                            {!! Form::open(['route' => ['sarans.destroy', $saran->id], 'method' => 'delete']) !!}
                                {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-sm', 'onclick' => "return confirm('Are you sure?')"]) !!}
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
            @include('adminlte-templates::common.paginate', ['records' => $sarans])
        </div>
    </div>
</div>
