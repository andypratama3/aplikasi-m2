<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control', 'required', 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>

<!-- Definition Field -->
<div class="form-group col-sm-6">
    {!! Form::label('definition', 'Aliases:') !!}
    {!! Form::text('definition', null, ['class' => 'form-control', 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>