<!-- Name Field -->
<div class="col-sm-12">
    {!! Form::label('name', 'Name:') !!}
    <p>{{ $jabatan->name }}</p>
</div>

<!-- Definition Field -->
<div class="col-sm-12">
    {!! Form::label('definition', 'Definition:') !!}
    <p>{{ $jabatan->definition }}</p>
</div>

<!-- Order Field -->
<div class="col-sm-12">
    {!! Form::label('order', 'Order:') !!}
    <p>{{ $jabatan->order }}</p>
</div>

<!-- Show In Header Field -->
<div class="col-sm-12">
    {!! Form::label('show_in_header', 'Show In Header:') !!}
    <p>{{ $jabatan->show_in_header }}</p>
</div>

<!-- Left Field -->
<div class="col-sm-12">
    {!! Form::label('left', 'Left:') !!}
    <p>{{ $jabatan->left }}</p>
</div>

<!-- Right Field -->
<div class="col-sm-12">
    {!! Form::label('right', 'Right:') !!}
    <p>{{ $jabatan->right }}</p>
</div>

<!-- Parent Id Field -->
<div class="col-sm-12">
    {!! Form::label('parent_id', 'Parent Id:') !!}
    <p>{{ $jabatan->parent_id }}</p>
</div>

