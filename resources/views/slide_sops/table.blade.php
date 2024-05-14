<div class="card-body p-0">
    <div class="table-responsive">
        <table class="table table-hover table-bordered table-striped default" id="slide-sops-table">
            <thead>
            <tr>
                <th>Gambar</th>
                <th>Halaman</th>
                <th colspan="3">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($slideSops as $slideSop)
                <tr>
                    {{-- gambar pakai spatie --}}
                    <td><img src="{{ $slideSop->getFirstMediaUrl('gambar_slide') }}" width="100px"></td>
                    <td>{{ $slideSop->halaman }}</td>
                    <td  style="width: 120px">
                        <div class='btn-group'>
                            <a href="{{ route('slideSops.show', [$slideSop->id]) }}"
                               class='btn btn-info btn-sm'>
                                <i class="fa fa-eye"></i>
                            </a>
                            @can('slideSops.edit')
                            <a href="{{ route('slideSops.edit', [$slideSop->id]) }}"
                                   class='btn btn-warning btn-sm'>
                                    <i class="fa fa-edit"></i>
                                </a>
                            @endcan
                            @can('slideSops.destroy')
                            {!! Form::open(['route' => ['slideSops.destroy', $slideSop->id], 'method' => 'delete']) !!}
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
            @include('adminlte-templates::common.paginate', ['records' => $slideSops])
        </div>
    </div>
</div>
