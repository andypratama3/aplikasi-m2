<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Nama:') !!}
    {!! Form::text('name', null, ['class' => 'form-control', 'required', 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>

<!-- Definition Field -->
<div class="form-group col-sm-6">
    {!! Form::label('definition', 'Definition:') !!}
    {!! Form::text('definition', null, ['class' => 'form-control', 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>

{{--<!-- Show In Header Field -->--}}
{{--<div class="form-group col-sm-6">--}}
{{--    {!! Form::label('show_in_header', 'Show In Header:') !!}--}}
{{--    {!! Form::number('show_in_header', null, ['class' => 'form-control']) !!}--}}
{{--</div>--}}

<!-- Parent Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('parent', 'Parent :') !!}
    {!! Form::select('parent', $parent, null, ['class' => 'form-control','placeholder'=>'--Parent']) !!}
</div>
