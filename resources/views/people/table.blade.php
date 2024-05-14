<div class="card-body p-0">
    <div class="table-responsive">
        <table class="table table-hover table-bordered table-striped default" id="people-table">
            <thead>
            <tr>
                <th>Name</th>
                <th>Tempat/TGL Lahir</th>
                <th>Pendidikan </th>
                <th>Jabatan </th>
                <th>Pangkat/Golongan</th>
                <th>Pendidikan </th>
                <th>Bidang </th>
                <th>Address</th>
                <th colspan="3">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($people as $person)
                <tr>
                    <td>{{ $person->name }}</td>
                    <td>
                        {{ $person->place_of_birth }}/{{ $person->date_of_birth?->format('d-m-Y') }}
                    </td>
                    <td>{{ $person->address }}</td>
                    <td>{{ $person->pendidikan?->name }}</td>
                    <td>{{ $person->jabatan?->name }}</td>
                    <td>{{ $person->pangkatGolongan?->name}}</td>
                    <td>{{ $person->bidang?->name }}</td>
                    <td  style="width: 120px">
                        <div class='btn-group'>
                            <a href="{{ route('people.show', [$person->id]) }}"
                               class='btn btn-info btn-sm'>
                                <i class="fa fa-eye"></i>
                            </a>
                            @can('people.edit')
                            <a href="{{ route('people.edit', [$person->id]) }}"
                                   class='btn btn-warning btn-sm'>
                                    <i class="fa fa-edit"></i>
                                </a>
                            @endcan
                            @can('people.destroy')
                            {!! Form::open(['route' => ['people.destroy', $person->id], 'method' => 'delete']) !!}
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
            @include('adminlte-templates::common.paginate', ['records' => $people])
        </div>
    </div>
</div>
