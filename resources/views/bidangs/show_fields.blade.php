<!-- Name Field -->
<div class="col-sm-12">
    {!! Form::label('name', 'Name:') !!}
    <p>{{ $bidang->name }}</p>
</div>

<!-- Definition Field -->
<div class="col-sm-12">
    {!! Form::label('definition', 'Definition:') !!}
    <p>{{ $bidang->definition }}</p>
</div>

<!-- Bidang Id Field -->
<div class="col-sm-12">
    {!! Form::label('bidang_id', 'Bidang Id:') !!}
    <p>{{ $bidang->bidang_id }}</p>
</div>

<!-- Left Field -->
<div class="col-sm-12">
    {!! Form::label('left', 'Left:') !!}
    <p>{{ $bidang->left }}</p>
</div>

<!-- Right Field -->
<div class="col-sm-12">
    {!! Form::label('right', 'Right:') !!}
    <p>{{ $bidang->right }}</p>
</div>

