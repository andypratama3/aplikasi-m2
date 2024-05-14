<!-- Pegawai Id Field -->
<div class="col-sm-12">
    {!! Form::label('nama_pegawai', 'Pegawai:') !!}
    <p>{{ $saran->pegawai->user->name }}</p>
</div>

<!-- nip Field -->
<div class="col-sm-12">
    {!! Form::label('nip', 'NIP:') !!}
    <p>{{ $saran->pegawai->nip }}</p>
</div>

<!-- Judul Field -->
<div class="col-sm-12">
    {!! Form::label('judul', 'Judul:') !!}
    <p>{{ $saran->judul }}</p>
</div>

<!-- Isi Field -->
<div class="col-sm-12">
    {!! Form::label('isi', 'Isi Pesan:') !!}
    <p>{{ $saran->isi }}</p>
</div>

