<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Nama:') !!}
    {!! Form::text('name', null, ['class' => 'form-control', 'maxlength' => 45, 'maxlength' => 45]) !!}
</div>

<!-- Description Field -->
<div class="form-group col-sm-6">
    {!! Form::label('description', 'Keterangan:') !!}
    {!! Form::text('description', null, ['class' => 'form-control', 'maxlength' => 45, 'maxlength' => 45]) !!}
</div>
