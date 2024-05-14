<!-- Name Field -->
<div class="form-group col-sm-12">
    {!! Form::label('name', 'Nama Lengkap:') !!}
    {!! Form::text('name', null, ['class' => 'form-control', 'required', 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>

<div class="form-group col-md-12">
    {!! Form::label('media', 'Foto :') !!}
    <div class="position-relative">
        @if(!isset($person))
            <x-media-library-attachment  name="media" rules="mimes:png,jpeg"/>
        @else
            <x-media-library-collection :model="$person" name="media" rules="mimes:png,jpeg"/>
        @endif
    </div>
</div>

<!-- Date Of Birth Field -->
<div class="form-group col-sm-6">
    {!! Form::label('date_of_birth', 'Tanggal Lahir:') !!}
    {!! Form::date('date_of_birth', $person->date_of_birth??date('d-m-Y'), ['class' => 'form-control','id'=>'date_of_birth']) !!}
</div>


<!-- Place Of Birth Field -->
<div class="form-group col-sm-6">
    {!! Form::label('place_of_birth', 'Tempat Lahir:') !!}
    {!! Form::text('place_of_birth', null, ['class' => 'form-control', 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>

<!-- Pendidikan Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('pendidikan_id', 'Pendidikan:') !!}
    {!! Form::select('pendidikan_id', $pendidikans,null, ['class' => 'form-control']) !!}
</div>

<!-- Jabatan Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('jabatan_id', 'Jabatan:') !!}
    {!! Form::select('jabatan_id', $jabatans,null, ['class' => 'form-control', 'required']) !!}
</div>

<!-- Pangkat Golongan Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('pangkat_golongan_id', 'Pangkat/Golongan:') !!}
    {!! Form::select('pangkat_golongan_id', $pangkatGolongans,null, ['class' => 'form-control', 'required']) !!}
</div>

<!-- Bidang Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('bidang_id', 'Bidang :') !!}
    {!! Form::select('bidang_id', $bidangs,null, ['class' => 'form-control']) !!}
</div>

<!-- Address Field -->
<div class="form-group col-sm-12">
    {!! Form::label('address', 'Address:') !!}
    {!! Form::text('address', null, ['class' => 'form-control', 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>
