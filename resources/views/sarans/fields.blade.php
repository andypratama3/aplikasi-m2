

{{-- pegawai id di backend --}}
<input type="hidden" name="pegawai_id" value="-">

<!-- Judul Field -->
<div class="form-group col-sm-6">
    {!! Form::label('judul', 'Judul / Prihal:') !!}
    {!! Form::text('judul', null, ['class' => 'form-control', 'maxlength' => 255]) !!}
</div>

<!-- Isi Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('isi', 'Isi Pesan:') !!}
    {!! Form::textarea('isi', null, ['class' => 'form-control', 'maxlength' => 65535]) !!}
</div>