<div class="card-body p-0">
    <div class="table-responsive">
        <table class="table table-hover table-bordered table-striped default" id="post-categories-table">
            <thead>
            <tr>
                <th>Judul</th>
                <th>Keterangan</th>
                <th colspan="3">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($postCategories as $postCategory)
                <tr>
                    <td>{{ $postCategory->title }}</td>
                    <td>{{ $postCategory->description }}</td>
                    <td  style="width: 120px">
                        <div class='btn-group'>
                            <a href="{{ route('postCategories.show', [$postCategory->id]) }}"
                               class='btn btn-info btn-sm'>
                                <i class="fa fa-eye"></i>
                            </a>
                            @can('postCategories.edit')
                            <a href="{{ route('postCategories.edit', [$postCategory->id]) }}"
                                   class='btn btn-warning btn-sm'>
                                    <i class="fa fa-edit"></i>
                                </a>
                            @endcan
                            @can('postCategories.destroy')
                            {!! Form::open(['route' => ['postCategories.destroy', $postCategory->id], 'method' => 'delete']) !!}
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
            @include('adminlte-templates::common.paginate', ['records' => $postCategories])
        </div>
    </div>
</div>
