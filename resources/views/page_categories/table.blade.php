<div class="card-body p-0">
    <div class="table-responsive">
        <table class="table" id="page-categories-table">
            <thead>
            <tr class="text-uppercase black">
                <th>No.</th>
                <th>Icon</th>
                <th>Nama</th>
                <th>Keterangan</th>
                <th>Custom Url</th>
                <th>External Url</th>
                <th>Order</th>
                <th colspan="3">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($pageCategories as $index=>$pageCategory)
                <tr>
                    <td>{{ $index+1 }}</td>
                    <td><img src="{{ $pageCategory->getFirstMediaUrl('default','thumb') }}" alt="" class="width-30"></td>
                    <td>{{ $pageCategory->name }}</td>
                    <td>{{ $pageCategory->keterangan }}</td>
                    <td>{{ $pageCategory->custom_url }}</td>
                    <td>{{ $pageCategory->external_url }}</td>
                    <td>
                        <div class="btn-group">
                            {!! Form::open(['route' => ['pageCategoriesIncrease', $pageCategory->id]]) !!}
                            {!! Form::button('<i class="fa fa-arrow-up"></i>', ['type' => 'submit', 'class' => 'btn btn-sm btn-info']) !!}
                            {!! Form::close() !!}

                            {!! Form::open(['route' => ['pageCategoriesDecrease', $pageCategory->id]]) !!}
                            {!! Form::button('<i class="fa fa-arrow-down"></i> '.$pageCategory->order, ['type' => 'submit', 'class' => 'btn btn-sm btn-danger']) !!}
                            {!! Form::close() !!}
                        </div>
                    </td>
                    <td  style="width: 120px">
                        {!! Form::open(['route' => ['pageCategories.destroy', $pageCategory->id], 'method' => 'delete']) !!}
                        <div class='btn-group'>
                            <a href="{{ route('pageCategories.show', [$pageCategory->id]) }}"
                               class='btn btn-green btn-sm'>
                                <i class="fa fa-eye"></i>
                            </a>
                            <a href="{{ route('pageCategories.edit', [$pageCategory->id]) }}"
                               class='btn btn-warning btn-sm'>
                                <i class="fa fa-pencil-square"></i>
                            </a>
                            {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-sm', 'onclick' => "return confirm('Are you sure?')"]) !!}
                        </div>
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <div class="card-footer clearfix">
        <div class="float-right">
            @include('adminlte-templates::common.paginate', ['records' => $pageCategories])
        </div>
    </div>
</div>
