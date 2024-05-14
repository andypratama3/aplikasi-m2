<div class="card-body p-0">
    <div class="table-responsive">
        <table class="table table-hover table-bordered table-striped default" id="pendaftaran-mutasi-statuses-table">
            <thead>
            <tr>
                <th>Pendaftaran Mutasi</th>
                <th>Approved By</th>
                <th>Status Mutasi</th>
                <th>Message</th>
                <th colspan="3">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($pendaftaranMutasiStatuses as $pendaftaranMutasiStatus)
                <tr>
                    <td>{{ $pendaftaranMutasiStatus->pendaftaranMutasi->pegawai->nip }}</td>
                    <td>{{ $pendaftaranMutasiStatus->approvedBy->name }}</td>
                    <td>{{ $pendaftaranMutasiStatus->statusMutasi->nama }}</td>
                    <td>{{ $pendaftaranMutasiStatus->message }}</td>
                    <td  style="width: 120px">
                        <div class='btn-group'>
                            <a href="{{ route('pendaftaranMutasiStatuses.show', [$pendaftaranMutasiStatus->id]) }}"
                               class='btn btn-info btn-sm'>
                                <i class="fa fa-eye"></i>
                            </a>
                            @can('pendaftaranMutasiStatuses.edit')
                            <a href="{{ route('pendaftaranMutasiStatuses.edit', [$pendaftaranMutasiStatus->id]) }}"
                                   class='btn btn-warning btn-sm'>
                                    <i class="fa fa-edit"></i>
                                </a>
                            @endcan
                            @can('pendaftaranMutasiStatuses.destroy')
                            {!! Form::open(['route' => ['pendaftaranMutasiStatuses.destroy', $pendaftaranMutasiStatus->id], 'method' => 'delete']) !!}
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
            @include('adminlte-templates::common.paginate', ['records' => $pendaftaranMutasiStatuses])
        </div>
    </div>
</div>
