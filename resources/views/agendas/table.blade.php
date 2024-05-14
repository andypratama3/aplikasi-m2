<!-- Sudah di modifikasi untuk Edit,Lihat,Hapus -->
<table class="table table-hover table-striped default table-responsive">
    <thead>
    <tr>
        <th><code>#</code></th>
        <th>Judul</th>
        <th>Pelaksana</th>
        <th>Kategori Agenda</th>
        <th>Tanggal Acara</th>
        <th>Waktu Acara</th>
        <th style="text-align: center">Action</th>
    </tr>
    </thead>
    <tbody>
    @php
        $no = 1;
    @endphp
    @foreach($agendas as $agenda)
        <tr>
            <td>{!! $no++ !!}</td>
            <td>{!! $agenda->title !!}</td>
            <td>{!! $agenda->pelaksana !!}</td>
            <td>{!! $agenda->agendaCategory->name !!}</td>
            <td>{!! date('Y-m-d',strtotime($agenda->schedule_date)) !!}</td>
            <td>{!! \Carbon\Carbon::parse($agenda->schedule_time)->format('h:i a') !!}</td>
            <td>
                {!! Form::open(['route' => ['agendas.destroy', $agenda->id], 'method' => 'delete']) !!}
                <div class="btn-group" role="group" aria-label="Basic example">
                    <a href="{!! route('agendas.show', [$agenda->id]) !!}" class="btn btn-sm btn-success"><i class="fa fa-eye"></i></a>
                    <a href="{!! route('agendas.edit', [$agenda->id]) !!}" class="btn btn-sm btn-warning"><i class="fa fa-pencil"></i></a>
                    {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-sm btn-danger', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
