<!-- Title Field -->
<div class="form-group col-sm-6">
    {!! Form::label('title', 'Judul :') !!}
    {!! Form::text('title', null, ['class' => 'form-control', 'maxlength' => 45, 'maxlength' => 45]) !!}
</div>

<!-- Description Field -->
<div class="form-group col-sm-6">
    {!! Form::label('description', 'Keterangan:') !!}
    {!! Form::text('description', null, ['class' => 'form-control', 'maxlength' => 45, 'maxlength' => 45]) !!}
</div>
