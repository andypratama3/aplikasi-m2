<!-- Kepangkat Golongan Field -->
<div class="form-group col-sm-6">
    {!! Form::label('kepangkat_golongan', 'Kepangkat Golongan:') !!}
    {!! Form::number('kepangkat_golongan', null, ['class' => 'form-control', 'required']) !!}
</div>

<!-- Nama Field -->
<div class="form-group col-sm-6">
    {!! Form::label('nama', 'Nama:') !!}
    {!! Form::text('nama', null, ['class' => 'form-control', 'required', 'maxlength' => 255]) !!}
</div>

<!-- Description Field -->
<div class="form-group col-sm-6">
    {!! Form::label('description', 'Description:') !!}
    {!! Form::text('description', null, ['class' => 'form-control', 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>