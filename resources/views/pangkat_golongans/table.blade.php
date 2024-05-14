<div class="card-body p-0">
    <div class="table-responsive">
        <table class="table table-hover table-bordered table-striped default" id="pangkat-golongans-table">
            <thead>
            <tr>
                <th>Name</th>
                <th>Aliases</th>
                <th colspan="3">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($pangkatGolongans as $pangkatGolongan)
                <tr>
                    <td>{{ $pangkatGolongan->name }}</td>
                    <td>{{ $pangkatGolongan->definition }}</td>
                    <td  style="width: 120px">
                        <div class='btn-group'>
                            <a href="{{ route('pangkatGolongans.show', [$pangkatGolongan->id]) }}"
                               class='btn btn-info btn-sm'>
                                <i class="fa fa-eye"></i>
                            </a>
                            @can('pangkatGolongans.edit')
                            <a href="{{ route('pangkatGolongans.edit', [$pangkatGolongan->id]) }}"
                                   class='btn btn-warning btn-sm'>
                                    <i class="fa fa-edit"></i>
                                </a>
                            @endcan
                            {{-- @can('pangkatGolongans.destroy')
                            {!! Form::open(['route' => ['pangkatGolongans.destroy', $pangkatGolongan->id], 'method' => 'delete']) !!}
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
            @include('adminlte-templates::common.paginate', ['records' => $pangkatGolongans])
        </div>
    </div>
</div>
