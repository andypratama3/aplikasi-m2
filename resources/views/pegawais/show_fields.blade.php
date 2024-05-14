<!-- User Id Field -->
<div class="col-sm-12">
    {!! Form::label('user_id', 'Nama:') !!}
    <p>{{ $pegawai->user->name }}</p>
</div>

<div class="col-sm-12">
    {!! Form::label('email', 'Email:') !!}
    <p>{{ $pegawai->user->email }}</p>
</div>

<!-- Nip Field -->
<div class="col-sm-12">
    {!! Form::label('nip', 'NIp:') !!}
    <p>{{ $pegawai->nip }}</p>
</div>

<!-- Tanggal Masuk Field -->
<div class="col-sm-12">
    {!! Form::label('tanggal_masuk', 'Tanggal Masuk:') !!}
    <p>{{ $pegawai->tanggal_masuk->format('d/m/Y') }}</p>
</div>

<!-- Date Of Birth Field -->
<div class="col-sm-12">
    {!! Form::label('date_of_birth', 'Date Of Birth:') !!}
    <p>{{ $pegawai->date_of_birth->format('d/m/Y') }}</p>
</div>

<!-- Place Of Birth Field -->
<div class="col-sm-12">
    {!! Form::label('place_of_birth', 'Place Of Birth:') !!}
    <p>{{ $pegawai->place_of_birth }}</p>
</div>

<!-- Address Field -->
<div class="col-sm-12">
    {!! Form::label('address', 'Address:') !!}
    <p>{{ $pegawai->address }}</p>
</div>

<!-- Pangkat Id Field -->
<div class="col-sm-12">
    {!! Form::label('pangkat_id', 'Pangkat:') !!}
    <p>{{ $pegawai->pangkat->nama }}</p>
</div>

<!-- Pangkat Id Field -->
<div class="col-sm-12">
    {!! Form::label('jenis_kelamin', 'Jenis Kelamin:') !!}
    <p>{{ $pegawai->jenis_kelamin }}</p>
</div>

<div class="col-sm-12">
    {!! Form::label('created_at', 'Dibuat pada:') !!}
    <p>{{ $pegawai->created_at->format('d/m/Y') }}</p>
</div>

<div class="col-sm-12">
    {!! Form::label('created_at', 'Diperbarui pada:') !!}
    <p>{{ $pegawai->updated_at->format('d/m/Y') }}</p>
</div>

<div class="col-sm-12">
    {!! Form::label('foto', 'Foto:') !!}
    @if (empty($pegawai->user->getFirstMedia('foto')))
        <img src="{{ asset('master/app-assets/images/gallery/user_profil.png') }}"
            class="img-fluid rounded height-200">
    @else
        <img src="{{ $pegawai->user->getFirstMedia('foto')->getUrl() }}" alt="avatar"
            class="rounded-circle bg-grey bg-lighten-4 p-0-1 height-200 width-200 box-shadow-0-1"
            style="object-fit: cover;object-position: top;">
    @endif
</div>
