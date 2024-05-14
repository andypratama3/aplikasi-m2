<div class="card-body p-0">
    <div class="table-responsive">
        <table class="table table-hover table-bordered table-striped default" id="pangkats-table">
            <thead>
            <tr>
                <th>Kepangkat Golongan</th>
                <th>Nama</th>
                <th>Description</th>
                <th colspan="3">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($pangkats as $pangkat)
                <tr>
                    <td>{{ $pangkat->kepangkat_golongan }}</td>
                    <td>{{ $pangkat->nama }}</td>
                    <td>{{ $pangkat->description }}</td>
                    <td  style="width: 120px">
                        <div class='btn-group'>
                            <a href="{{ route('pangkats.show', [$pangkat->id]) }}"
                               class='btn btn-info btn-sm'>
                                <i class="fa fa-eye"></i>
                            </a>
                            @can('pangkats.edit')
                            <a href="{{ route('pangkats.edit', [$pangkat->id]) }}"
                                   class='btn btn-warning btn-sm'>
                                    <i class="fa fa-edit"></i>
                                </a>
                            @endcan
                            {{-- @can('pangkats.destroy')
                            {!! Form::open(['route' => ['pangkats.destroy', $pangkat->id], 'method' => 'delete']) !!}
                                {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-sm', 'onclick' => "return confirm('Are you sure?')"]) !!}
                                {!! Form::close() !!}
                            @endcan --}}
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <div class="card-footer clearfix">
        <div class="float-right">
            @include('adminlte-templates::common.paginate', ['records' => $pangkats])
        </div>
    </div>
</div>
