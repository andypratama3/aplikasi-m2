<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control', 'required', 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>

<!-- Definition Field -->
<div class="form-group col-sm-6">
    {!! Form::label('definition', 'Definition:') !!}
    {!! Form::text('definition', null, ['class' => 'form-control', 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>

<!-- Bidang Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('bidang_id', 'Bidang :') !!}
    {!! Form::select('bidang_id', $parent,null, ['class' => 'form-control', 'placeholder'=>'--Parent']) !!}
</div>
