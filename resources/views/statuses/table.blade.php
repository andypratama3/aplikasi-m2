<div class="card-body p-0">
    <div class="table-responsive">
        <table class="table table-hover table-bordered table-striped default" id="statuses-table">
            <thead>
            <tr>
                <th>Nama</th>
                <th colspan="3">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($statuses as $status)
                <tr>
                    <td>{{ $status->nama }}</td>
                    <td  style="width: 120px">
                        <div class='btn-group'>
                            <a href="{{ route('statuses.show', [$status->id]) }}"
                               class='btn btn-info btn-sm'>
                                <i class="fa fa-eye"></i>
                            </a>
                            @can('statuses.edit')
                            <a href="{{ route('statuses.edit', [$status->id]) }}"
                                   class='btn btn-warning btn-sm'>
                                    <i class="fa fa-edit"></i>
                                </a>
                            @endcan
                            @can('statuses.destroy')
                            {!! Form::open(['route' => ['statuses.destroy', $status->id], 'method' => 'delete']) !!}
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
            @include('adminlte-templates::common.paginate', ['records' => $statuses])
        </div>
    </div>
</div>
