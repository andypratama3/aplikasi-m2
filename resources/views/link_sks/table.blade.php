<div class="card-body p-0">
    <div class="table-responsive">
        <table class="table table-hover table-bordered table-striped default" id="link-sks-table">
            <thead>
            <tr>
                <th>Link</th>
                <th>Dari Tanggal</th>
                <th>Sampai Tanggal</th>
                <th colspan="3">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($linkSks as $linkSk)
                <tr>
                    <td>{{ $linkSk->link }}</td>
                    <td>{{ $linkSk->dari_tanggal?->format('d/m/Y') ?? '' }}</td>
                    <td>{{ $linkSk->sampai_tanggal?->format('d/m/Y') ?? '' }}</td>
                    <td  style="width: 120px">
                        <div class='btn-group'>
                            <a href="{{ route('linkSks.show', [$linkSk->id]) }}"
                               class='btn btn-info btn-sm'>
                                <i class="fa fa-eye"></i>
                            </a>
                            @can('linkSks.edit')
                            <a href="{{ route('linkSks.edit', [$linkSk->id]) }}"
                                   class='btn btn-warning btn-sm'>
                                    <i class="fa fa-edit"></i>
                                </a>
                            @endcan
                            @can('linkSks.destroy')
                            {!! Form::open(['route' => ['linkSks.destroy', $linkSk->id], 'method' => 'delete']) !!}
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
            @include('adminlte-templates::common.paginate', ['records' => $linkSks])
        </div>
    </div>
</div>
