<div class="card-body p-0">
    <div class="table-responsive">
        <table class="table" id="pages-table">
            <thead>
            <tr class="text-uppercase black">
                <th>No.</th>
                <th>Judul</th>
                <th>Custom Url</th>
                <th>External Url</th>
                <th>Page Category</th>
                <th>Highlight</th>
                <th colspan="3">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($pages as $index=>$page)
                <tr>
                    <td>{{ $index+1 }}</td>
                    <td>{{ $page->judul }}</td>
                    <td>{{ $page->custom_url }}</td>
                    <td>{{ $page->external_url }}</td>
                    <td><span class="badge badge-info">{{ $page['pageCategory']['nama'] }}</span></td>
                    <td>
{{--                        @if($page->highlight == 0)--}}
{{--                            {!! Form::open(['route' => ['pageHighlight', $page->id]]) !!}--}}
{{--                            {!! Form::button('Highlight', ['type' => 'submit', 'value'=>1,'name'=>'value', 'class' => 'btn btn-sm btn-info']) !!}--}}
{{--                            {!! Form::close() !!}--}}
{{--                        @else--}}
{{--                            {!! Form::open(['route' => ['pageHighlight', $page->id]]) !!}--}}
{{--                            {!! Form::button('Unhighlight', ['type' => 'submit','value'=>0, 'name'=>'value','class' => 'btn btn-sm btn-danger']) !!}--}}
{{--                            {!! Form::close() !!}--}}
{{--                        @endif--}}
                    </td>
                    <td  style="width: 120px">
                        {!! Form::open(['route' => ['pages.destroy', $page->id], 'method' => 'delete']) !!}
                        <div class='btn-group'>
                            <a href="{{ route('pages.show', [$page->id]) }}"
                               class='btn btn-success btn-sm'>
                                <i class="fa fa-eye"></i>
                            </a>
                            <a href="{{ route('pages.edit', [$page->id]) }}"
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
            @include('adminlte-templates::common.paginate', ['records' => $pages])
        </div>
    </div>
</div>
