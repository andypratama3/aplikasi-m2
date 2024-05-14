<!-- Pegawai Id Field -->
<div class="col-sm-12">
    {!! Form::label('pegawai_id', 'Pegawai') !!}
    <p>{{ $pendaftaranMutasi->pegawai->user->name }}</p>
</div>

<!-- Tujuan Instansi Field -->
<div class="col-sm-12">
    {!! Form::label('tujuan_instansi', 'Tujuan Instansi:') !!}
    <p>{{ $pendaftaranMutasi->tujuanInstansi->nama }}</p>
</div>

<!-- Asal Instansi Field -->
<div class="col-sm-12">
    {!! Form::label('asal_instansi', 'Asal Instansi:') !!}
    <p>{{ $pendaftaranMutasi->asalInstansi->nama }}</p>
</div>

<!-- Alasan Mutasi Field -->
<div class="col-sm-12">
    {!! Form::label('alasan_mutasi', 'Alasan Mutasi:') !!}
    <p>{{ $pendaftaranMutasi->alasan_mutasi }}</p>
</div>

<!-- Jabatan Asal Field -->
<div class="col-sm-12">
    {!! Form::label('jabatan_asal', 'Jabatan Asal:') !!}
    <p>{{ $pendaftaranMutasi->jabatan_asal }}</p>
</div>

<!-- Jabatan Tujuan Field -->
<div class="col-sm-12">
    {!! Form::label('jabatan_tujuan', 'Jabatan Tujuan:') !!}
    <p>{{ $pendaftaranMutasi->jabatan_tujuan }}</p>
</div>

<div class="col-sm-12">
    {!! Form::label('pangkat', 'Pangkat') !!}
    <p>{{ $pendaftaranMutasi->pegawai->pangkat->nama }}</p>
</div>

<div class="col-sm-12">
    {!! Form::label('pangkat', 'Pangkat Golongan') !!}
    <p>{{ $pendaftaranMutasi->pegawai->pangkatGolongan->name }}</p>
</div>

<div class="col-sm-12">
    {!! Form::label('unit_kerja_asal', 'Unit Kerja Asal') !!}
    <p>{{ $pendaftaranMutasi->unit_kerja_asal }}</p>
</div>

<div class="col-sm-12">
    {!! Form::label('unit_kerja_tujuan', 'Unit Kerja Tujuan') !!}
    <p>{{ $pendaftaranMutasi->unit_kerja_tujuan }}</p>
</div>

<div class="col-sm-12">
    {!! Form::label('unit_kerja_asal', 'Unit kerja/Bidang/Kelurahan (Asal) menggunakan huruf kapital tanpa disingkat') !!}
    <p>{{ $pendaftaranMutasi->asal_instansi_detail }}</p>
</div>

<div class="col-sm-12">
    {!! Form::label('unit_kerja_tujuan', 'Unit kerja/Bidang/Kelurahan (Tujuan) menggunakan huruf kapital tanpa disingkat') !!}
    <p>{{ $pendaftaranMutasi->tujuan_instansi_detail }}</p>
</div>

<div class="col-sm-12">
    {!! Form::label('surat_pengantar', 'Surat Pengantar:') !!}
    @if ($pendaftaranMutasi->hasMedia('surat_pengantar'))
        <ul>
            @foreach ($pendaftaranMutasi->getMedia('surat_pengantar') as $media)
                <li>
                    <a class="btn btn-dark" href="{{ $media->getUrl() }}" target="_blank">Download</a>
                </li>
            @endforeach
        </ul>
    @else
        <p> - Belum ada file</p>
    @endif
</div>

<div class="col-sm-12">
    {!! Form::label('surat_permohonan_pindah', 'Surat Permohonan Pindah ASN:') !!}
    @if ($pendaftaranMutasi->hasMedia('surat_permohonan_pindah'))
        <ul>
            @foreach ($pendaftaranMutasi->getMedia('surat_permohonan_pindah') as $media)
                <li>
                    <a class="btn btn-dark" href="{{ $media->getUrl() }}" target="_blank">Download</a>
                </li>
            @endforeach
        </ul>
    @else
        <p> - Belum ada file</p>
    @endif
</div>

<div class="col-sm-12">
    {!! Form::label('sk_kenaikan_pangkat', 'SK Kenaikan Pangkat/SK Jabatan Terakhir di Legalisir:') !!}
    @if ($pendaftaranMutasi->hasMedia('sk_kenaikan_pangkat'))
        <ul>
            @foreach ($pendaftaranMutasi->getMedia('sk_kenaikan_pangkat') as $media)
                <a class="btn btn-dark" href="{{ $media->getUrl() }}" target="_blank">Download</a>
            @endforeach
        </ul>
    @else
        <p> - Belum ada file</p>
    @endif
</div>

<div class="col-sm-12">
    {!! Form::label('rekomendasi_menerima_anjab', 'Rekomendasi Menerima dan Anjab:') !!}
    @if ($pendaftaranMutasi->hasMedia('rekomendasi_menerima_anjab'))
        <ul>
            @foreach ($pendaftaranMutasi->getMedia('rekomendasi_menerima_anjab') as $media)
                <a class="btn btn-dark" href="{{ $media->getUrl() }}" target="_blank">Download</a>
            @endforeach
        </ul>
    @else
        <p> - Belum ada file</p>
    @endif
</div>

<div class="col-sm-12">
    {!! Form::label('rekomendasi_melepas_anjab', 'Rekomendasi Melepas dan Anjab:') !!}
    @if ($pendaftaranMutasi->hasMedia('rekomendasi_melepas_anjab'))
        <ul>
            @foreach ($pendaftaranMutasi->getMedia('rekomendasi_melepas_anjab') as $media)
                <a class="btn btn-dark" href="{{ $media->getUrl() }}" target="_blank">Download</a>
            @endforeach
        </ul>
    @else
        <p> - Belum ada file</p>
    @endif
</div>

<div class="col-sm-12">
    {!! Form::label('surat_skp', 'Foto Copy SKP 1 Tahun Terakhir di Legalisir:') !!}
    @if ($pendaftaranMutasi->hasMedia('surat_skp'))
        <ul>
            @foreach ($pendaftaranMutasi->getMedia('surat_skp') as $media)
                <a class="btn btn-dark" href="{{ $media->getUrl() }}" target="_blank">Download</a>
            @endforeach
        </ul>
    @else
        <p> - Belum ada file</p>
    @endif
</div>

@if ($pendaftaranMutasi->tujuanInstansi->jenis_instansi == 'kesehatan')

    <div class="col-sm-12">
        {!! Form::label('persetujuan_dinas_kesehatan', 'Persetujuan/Rekomendasi dari Dinas kesehatan:') !!}
        @if ($pendaftaranMutasi->hasMedia('persetujuan_dinas_kesehatan'))
            <ul>
                @foreach ($pendaftaranMutasi->getMedia('persetujuan_dinas_kesehatan') as $media)
                    <a class="btn btn-dark" href="{{ $media->getUrl() }}" target="_blank">Download</a>
                @endforeach
            </ul>
        @else
            <p> - Belum ada file</p>
        @endif
    </div>

    <div class="col-sm-12">
        {!! Form::label('rekomendasi_upt', 'Rekomendasi Dari UPT.Dinas kesehatan Puskesmas dan Anjab:') !!}
        @if ($pendaftaranMutasi->hasMedia('rekomendasi_upt'))
            <ul>
                @foreach ($pendaftaranMutasi->getMedia('rekomendasi_upt') as $media)
                    <a class="btn btn-dark" href="{{ $media->getUrl() }}" target="_blank">Download</a>
                @endforeach
            </ul>
        @else
            <p> - Belum ada file</p>
        @endif
    </div>

@endif

@if ($pendaftaranMutasi->tujuanInstansi->jenis_instansi == 'pendidikan')

    <div class="col-sm-12">
        {!! Form::label('persetujuan_dinas_pendidikan', ' Persetujuan/Rekomendasi dari Dinas pendidikan dan Kebudayaan Kabupaten:') !!}
        @if ($pendaftaranMutasi->hasMedia('persetujuan_dinas_pendidikan'))
            <ul>
                @foreach ($pendaftaranMutasi->getMedia('persetujuan_dinas_pendidikan') as $media)
                    <a class="btn btn-dark" href="{{ $media->getUrl() }}" target="_blank">Download</a>
                @endforeach
            </ul>
        @else
            <p> - Belum ada file</p>
        @endif
    </div>

    <div class="col-sm-12">
        {!! Form::label('persetujuan_kepala_cabang_dinas', ' Persetujuan/Rekomendasi dari Kepala Cabang Dinas Kec.:') !!}
        @if ($pendaftaranMutasi->hasMedia('persetujuan_kepala_cabang_dinas'))
            <ul>
                @foreach ($pendaftaranMutasi->getMedia('persetujuan_kepala_cabang_dinas') as $media)
                    <a class="btn btn-dark" href="{{ $media->getUrl() }}" target="_blank">Download</a>
                @endforeach
            </ul>
        @else
            <p> - Belum ada file</p>
        @endif
    </div>

    <div class="col-sm-12">
        {!! Form::label('rekomendasi_kepsek_menerima', ' Rekomendasi kepala Sekolah yang menerima Asli :') !!}
        @if ($pendaftaranMutasi->hasMedia('rekomendasi_kepsek_menerima'))
            <ul>
                @foreach ($pendaftaranMutasi->getMedia('rekomendasi_kepsek_menerima') as $media)
                    <a class="btn btn-dark" href="{{ $media->getUrl() }}" target="_blank">Download</a>
                @endforeach
            </ul>
        @else
            <p> - Belum ada file</p>
        @endif
    </div>

    <div class="col-sm-12">
        {!! Form::label('rekomendasi_kepsek_melepas', ' Rekomendasi kepala Sekolah yang melepas Asli :') !!}
        @if ($pendaftaranMutasi->hasMedia('rekomendasi_kepsek_melepas'))
            <ul>
                @foreach ($pendaftaranMutasi->getMedia('rekomendasi_kepsek_melepas') as $media)
                    <a class="btn btn-dark" href="{{ $media->getUrl() }}" target="_blank">Download</a>
                @endforeach
            </ul>
        @else
            <p> - Belum ada file</p>
        @endif
    </div>

    <div class="col-sm-12">
        {!! Form::label('data_keadan_guru', 'Data Keadaan Guru (DKG)di 2 Sekolah Asli Rekomendasi kepala Sekolah yang melepas Asli :') !!}
        @if ($pendaftaranMutasi->hasMedia('data_keadan_guru'))
            <ul>
                @foreach ($pendaftaranMutasi->getMedia('data_keadan_guru') as $media)
                    <a class="btn btn-dark" href="{{ $media->getUrl() }}" target="_blank">Download</a>
                @endforeach
            </ul>
        @else
            <p> - Belum ada file</p>
        @endif
    </div>
@endif
