<div class="card-body p-0">
    <div class="table-responsive">
        <table class="table table-hover table-bordered table-striped default" id="jabatans-table">
            <thead>
            <tr>
                <th>Nama</th>
                <th>Keterangan</th>
                <th>Parent</th>
                <th>Order</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($jabatans as $jabatan)
                <tr>
                    <td>{{ $jabatan->name }}</td>
                    <td>{{ $jabatan->definition }}</td>
                    <td>{{ $jabatan->parent?->name }}</td>
                    <td>
                        <div class="btn-group">
                            {!! Form::open(['route' => ['jabatansIncrease', $jabatan->id]]) !!}
                            {!! Form::button('<i class="fa fa-arrow-up"></i>', ['type' => 'submit', 'class' => 'btn btn-sm btn-info']) !!}
                            {!! Form::close() !!}

                            {!! Form::open(['route' => ['jabatansDecrease', $jabatan->id]]) !!}
                            {!! Form::button('<i class="fa fa-arrow-down"></i> '.$jabatan->order, ['type' => 'submit', 'class' => 'btn btn-sm btn-danger']) !!}
                            {!! Form::close() !!}
                        </div>
                    </td>
                    <td style="width: 120px">
                        <div class='btn-group'>
                            <a href="{{ route('jabatans.show', [$jabatan->id]) }}"
                               class='btn btn-info btn-sm'>
                                <i class="fa fa-eye"></i>
                            </a>
                            @can('jabatans.edit')
                            <a href="{{ route('jabatans.edit', [$jabatan->id]) }}"
                                   class='btn btn-warning btn-sm'>
                                    <i class="fa fa-edit"></i>
                                </a>
                            @endcan
                            @can('jabatans.destroy')
                            {!! Form::open(['route' => ['jabatans.destroy', $jabatan->id], 'method' => 'delete']) !!}
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
            @include('adminlte-templates::common.paginate', ['records' => $jabatans])
        </div>
    </div>
</div>
