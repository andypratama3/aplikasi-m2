<div class="card-body p-0">
    <div class="table-responsive">
        <table class="table table-hover table-bordered table-striped default" id="kegiatans-table">
            <thead>
            <tr>
                <th>Title</th>
                <th>Content</th>
                <th>Schedule Date</th>
                <th>Schedule Time</th>
                <th>Tipe Acara</th>
                <th>Location</th>
                <th colspan="3">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($kegiatans as $kegiatan)
                <tr>
                    <td>{{ $kegiatan->title }}</td>
                    <td><p class="desc-p">{{ $kegiatan->content }}</p></td>
                    <td>{{ $kegiatan->schedule_date?->format('d-m-y') }}</td>
                    <td>{{ $kegiatan->schedule_time }}</td>
                    <td>{{ $kegiatan->tipe_acara }}</td>
                    <td>{{ $kegiatan->location }}</td>
                    <td  style="width: 120px">
                        <div class='btn-group'>
                            <a href="{{ route('kegiatans.show', [$kegiatan->id]) }}"
                               class='btn btn-info btn-sm'>
                                <i class="fa fa-eye"></i>
                            </a>
                            @can('kegiatans.edit')
                            <a href="{{ route('kegiatans.edit', [$kegiatan->id]) }}"
                                   class='btn btn-warning btn-sm'>
                                    <i class="fa fa-edit"></i>
                                </a>
                            @endcan
                            @can('kegiatans.destroy')
                            {!! Form::open(['route' => ['kegiatans.destroy', $kegiatan->id], 'method' => 'delete']) !!}
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
            @include('adminlte-templates::common.paginate', ['records' => $kegiatans])
        </div>
    </div>
</div>
