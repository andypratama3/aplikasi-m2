<div class="card-body p-0">
    <div class="table-responsive">
        <table class="table" id="pages-table">
            <thead>
            <tr class="text-uppercase black">
                <th>No.</th>
                <th>Judul</th>
                <th>Content</th>
                <th>Post Category</th>
                <th colspan="3">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($posts as $index=>$post)
                <tr>
                    <td>{{ $index+1 }}</td>
                    <td>{{ $post->title }}</td>
                    <td><p class="desc-p">{!! $post->content !!}</p></td>
                    <td><span class="badge badge-info">{{ $post->postCategory->title }}</span></td>
                    <td  style="width: 120px">
                        {!! Form::open(['route' => ['posts.destroy', $post->id], 'method' => 'delete']) !!}
                        <div class='btn-group'>
                            <a href="{{ route('posts.show', [$post->id]) }}"
                               class='btn btn-success btn-sm'>
                                <i class="fa fa-eye"></i>
                            </a>
                            <a href="{{ route('posts.edit', [$post->id]) }}"
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
            @include('adminlte-templates::common.paginate', ['records' => $posts])
        </div>
    </div>
</div>

