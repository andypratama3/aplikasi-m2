<div class="form-group col-sm-6">
    {!! Form::label('gambar_slide', 'Gambar Slide SOP:') !!}
    @if ($isCreatedPage)
        <x-media-library-attachment name="gambar_slide" rules="mimes:jpg,jpeg,png" maxFiles="1" required />
    @else
        <x-media-library-collection :model="$slideSop" name="gambar_slide" collection="gambar_slide"
            rules="mimes:jpg,jpeg,png" maxFiles="1" />
    @endif
</div>

<!-- Halaman Field -->
<div class="form-group col-sm-6">
    {!! Form::label('halaman', 'Halaman:') !!}
    {{-- minimal 1 --}}
    {!! Form::number('halaman', null, ['class' => 'form-control', 'required','min:1']) !!}
</div>

<!-- Description Field -->
<div class="form-group col-sm-6">
    {!! Form::label('description', 'Description:') !!}
    {!! Form::text('description', null, ['class' => 'form-control', 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>