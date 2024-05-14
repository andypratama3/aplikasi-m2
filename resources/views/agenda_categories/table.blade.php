<div class="card-body p-0">
    <div class="table-responsive">
        <table class="table table-hover table-bordered table-striped default" id="agenda-categories-table">
            <thead>
            <tr>
                <th>Nama</th>
                <th>Keterangan</th>
                <th colspan="3">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($agendaCategories as $agendaCategory)
                <tr>
                    <td>{{ $agendaCategory->name }}</td>
                    <td>{{ $agendaCategory->description }}</td>
                    <td  style="width: 120px">
                        <div class='btn-group'>
                            <a href="{{ route('agendaCategories.show', [$agendaCategory->id]) }}"
                               class='btn btn-info btn-sm'>
                                <i class="fa fa-eye"></i>
                            </a>
                            @can('agendaCategories.edit')
                            <a href="{{ route('agendaCategories.edit', [$agendaCategory->id]) }}"
                                   class='btn btn-warning btn-sm'>
                                    <i class="fa fa-edit"></i>
                                </a>
                            @endcan
                            @can('agendaCategories.destroy')
                            {!! Form::open(['route' => ['agendaCategories.destroy', $agendaCategory->id], 'method' => 'delete']) !!}
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
            @include('adminlte-templates::common.paginate', ['records' => $agendaCategories])
        </div>
    </div>
</div>
