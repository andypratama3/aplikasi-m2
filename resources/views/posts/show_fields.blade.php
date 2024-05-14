<!-- Sudah di modifikasi -->
<!-- Title Field -->
<div class="media">
    <div class="media-body">
        <h5 class="media-heading">
            {!! Form::label('title', 'Title:') !!}
        </h5>
        {!! $post->title !!}
    </div>
</div>

<!-- Sudah di modifikasi -->
<!-- Content Field -->
<div class="media">
    <div class="media-body">
        <h5 class="media-heading">
            {!! Form::label('content', 'Content:') !!}
        </h5>
        {!! $post->content !!}
    </div>
</div>

<!-- Sudah di modifikasi -->

<!-- Post Category Id Field -->
<div class="media">
    <div class="media-body">
        <h5 class="media-heading">
            {!! Form::label('post_category_id', 'Post Category Id:') !!}
        </h5>
        {!! $post->post_category_id !!}
    </div>
</div>

<!-- Sudah di modifikasi -->
<!-- Slug Field -->
<div class="media">
    <div class="media-body">
        <h5 class="media-heading">
            {!! Form::label('slug', 'Slug:') !!}
        </h5>
        {!! $post->slug !!}
    </div>
</div>

