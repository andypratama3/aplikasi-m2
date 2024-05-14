<div class="card-body p-0">
    <div class="table-responsive">
        <table class="table table-hover table-bordered table-striped default" id="perangkat-daerahs-table">
            <thead>
            <tr>
                <th>Nama</th>
                <th>Alamat</th>
                <th>Kode</th>
                <th colspan="3">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($perangkatDaerahs as $perangkatDaerah)
                <tr>
                    <td>{{ $perangkatDaerah->nama }}</td>
                    <td>{{ $perangkatDaerah->alamat }}</td>
                    <td>{{ $perangkatDaerah->kode }}</td>
                    <td  style="width: 120px">
                        <div class='btn-group'>
                            <a href="{{ route('perangkatDaerahs.show', [$perangkatDaerah->id]) }}"
                               class='btn btn-info btn-sm'>
                                <i class="fa fa-eye"></i>
                            </a>
                            @can('perangkatDaerahs.edit')
                            <a href="{{ route('perangkatDaerahs.edit', [$perangkatDaerah->id]) }}"
                                   class='btn btn-warning btn-sm'>
                                    <i class="fa fa-edit"></i>
                                </a>
                            @endcan
                            @can('perangkatDaerahs.destroy')
                            {!! Form::open(['route' => ['perangkatDaerahs.destroy', $perangkatDaerah->id], 'method' => 'delete']) !!}
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
            @include('adminlte-templates::common.paginate', ['records' => $perangkatDaerahs])
        </div>
    </div>
</div>
