<!-- Nama Field -->
<div class="col-sm-12">
    {!! Form::label('nama', 'Nama:') !!}
    <p>{{ $pageCategory->nama }}</p>
</div>

<!-- Keterangan Field -->
<div class="col-sm-12">
    {!! Form::label('keterangan', 'Keterangan:') !!}
    <p>{{ $pageCategory->keterangan }}</p>
</div>

<!-- Name English Field -->
<div class="col-sm-12">
    {!! Form::label('name_english', 'Name English:') !!}
    <p>{{ $pageCategory->name_english }}</p>
</div>

<!-- Keterangan English Field -->
<div class="col-sm-12">
    {!! Form::label('keterangan_english', 'Keterangan English:') !!}
    <p>{{ $pageCategory->keterangan_english }}</p>
</div>

<!-- Custom Url Field -->
<div class="col-sm-12">
    {!! Form::label('custom_url', 'Custom Url:') !!}
    <p>{{ $pageCategory->custom_url }}</p>
</div>

<!-- Parent Page Category Id Field -->
<div class="col-sm-12">
    {!! Form::label('parent_page_category_id', 'Parent Page Category Id:') !!}
    <p>{{ $pageCategory->parent_page_category_id }}</p>
</div>

