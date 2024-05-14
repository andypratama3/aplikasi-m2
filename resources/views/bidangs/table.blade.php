<div class="card-body p-0">
    <div class="table-responsive">
        <table class="table table-hover table-bordered table-striped default" id="bidangs-table">
            <thead>
            <tr>
                <th>Nama</th>
                <th>Keterangan</th>
                <th>Parent</th>
                <th colspan="3">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($bidangs as $bidang)
                <tr>
                    <td>{{ $bidang->name }}</td>
                    <td>{{ $bidang->definition }}</td>
                    <td>{{ $bidang->parent?->name }}</td>
                    <td  style="width: 120px">
                        <div class='btn-group'>
                            <a href="{{ route('bidangs.show', [$bidang->id]) }}"
                               class='btn btn-info btn-sm'>
                                <i class="fa fa-eye"></i>
                            </a>
                            @can('bidangs.edit')
                            <a href="{{ route('bidangs.edit', [$bidang->id]) }}"
                                   class='btn btn-warning btn-sm'>
                                    <i class="fa fa-edit"></i>
                                </a>
                            @endcan
                            @can('bidangs.destroy')
                            {!! Form::open(['route' => ['bidangs.destroy', $bidang->id], 'method' => 'delete']) !!}
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
            @include('adminlte-templates::common.paginate', ['records' => $bidangs])
        </div>
    </div>
</div>
