<div class="card-body p-0">
    <div class="table-responsive">
        <table class="table table-hover table-bordered table-striped default" id="pendidikans-table">
            <thead>
            <tr>
                <th>Name</th>
                <th>Definition</th>
                <th colspan="3">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($pendidikans as $pendidikan)
                <tr>
                    <td>{{ $pendidikan->name }}</td>
                    <td>{{ $pendidikan->definition }}</td>
                    <td  style="width: 120px">
                        <div class='btn-group'>
                            <a href="{{ route('pendidikans.show', [$pendidikan->id]) }}"
                               class='btn btn-info btn-sm'>
                                <i class="fa fa-eye"></i>
                            </a>
                            @can('pendidikans.edit')
                            <a href="{{ route('pendidikans.edit', [$pendidikan->id]) }}"
                                   class='btn btn-warning btn-sm'>
                                    <i class="fa fa-edit"></i>
                                </a>
                            @endcan
                            @can('pendidikans.destroy')
                            {!! Form::open(['route' => ['pendidikans.destroy', $pendidikan->id], 'method' => 'delete']) !!}
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
            @include('adminlte-templates::common.paginate', ['records' => $pendidikans])
        </div>
    </div>
</div>
