<!-- Pegawai Id Field -->
@role(['admin','super-admin'])
    @if ($isUpdatePage == false)
        <div class="form-group col-sm-6">
            <label for="pegawai_id">Pegawai:</label>
            <select name="pegawai_id" id="pegawai_id" class="form-control" required>
                <option value="">Pilih Pegawai</option>
                @foreach ($pegawaiData as $pegawai)
                    <option value="{{ $pegawai->id }}">{{ $pegawai->user->name }} - {{ $pegawai->nip }}</option>
                @endforeach
            </select>
        </div>
    @else
        <input type="hidden" value="-" name="pegawai_id">
    @endif
@endrole

@role('pegawai')
    <input type="hidden" value="-" name="pegawai_id">
@endrole

<div class="form-group col-sm-6">
    {!! Form::label('nama_readonly', 'Nama :') !!}
    {!! Form::text('nama_readonly', $pegawaiSekarang->user->name, [
        'readonly' => 'readonly',
        'class' => 'form-control',
    ]) !!}
    <input type="hidden" name="name" value="{{ $pegawaiSekarang->user->name }}">
</div>

<div class="form-group col-sm-6">
    {!! Form::label('nip_readonly', 'NIP :') !!}
    {!! Form::text('nip_readonly', $pegawaiSekarang->nip, [
        'readonly' => 'readonly',
        'class' => 'form-control',
    ]) !!}
    <input type="hidden" name="nip" value="{{ $pegawaiSekarang->nip }}">
</div>

<div class="form-group col-sm-6">
    {!! Form::label('pangkat_id', 'Pangkat :') !!}
    {!! Form::select('pangkat_id', $pangkats, $pegawaiSekarang->pangkat_id ?? null, [
        'class' => 'form-control',
        'placeholder' => 'Pilih Pangkat',
        'required',
    ]) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('pangkat_golongan_id', 'Pangkat Golongan:') !!}
    {!! Form::select('pangkat_golongan_id', $pangkatGolongans, $pegawaiSekarang->pangkat_golongan_id ?? null, [
        'class' => 'form-control',
        'placeholder' => 'Pilih Pangkat Golongan',
        'required',
        'disabled',
    ]) !!}
</div>

<!-- Jabatan Asal Field -->
<div class="form-group col-sm-6">
    {!! Form::label('jabatan_asal', 'Jabatan Asal: (Sesuai SK Terakhir)') !!}
    {!! Form::text('jabatan_asal', null, ['class' => 'form-control', 'maxlength' => 255, 'required']) !!}
</div>

<!-- Jabatan Tujuan Field -->
<div class="form-group col-sm-6">
    {!! Form::label('jabatan_tujuan', 'Jabatan Tujuan: (Jabatan Tujuan Berdasarkan Rekom)') !!}
    {!! Form::text('jabatan_tujuan', null, ['class' => 'form-control', 'maxlength' => 255, 'required']) !!}
</div>

{{-- <!-- Jabatan Tujuan Field -->
<div class="form-group col-sm-6">
    {!! Form::label('unit_kerja_asal', 'Unit Kerja Asal') !!}
    {!! Form::text('unit_kerja_asal', null, ['class' => 'form-control', 'maxlength' => 255]) !!}
</div>

<!-- Jabatan Tujuan Field -->
<div class="form-group col-sm-6">
    {!! Form::label('unit_kerja_tujuan', 'Unit Kerja Tujuan') !!}
    {!! Form::text('unit_kerja_tujuan', null, ['class' => 'form-control', 'maxlength' => 255]) !!}
</div> --}}

<div class="form-group col-sm-6">
    {!! Form::label('asal_instansi', 'Asal Instansi \ Perangkat Daerah:') !!}
    {!! Form::select('asal_instansi', $perangkatDaerahs, $pendaftaranMutasi->asal_instansi ?? null, [
        'class' => 'form-control',
        'placeholder' => 'Pilih Instansi',
        'required',
    ]) !!}
</div>

<!-- asal_instansi_detail -->
<div class="form-group col-sm-6">
    {!! Form::label('asal_instansi_detail', 'Unit kerja/Bidang/Kelurahan (Asal) menggunakan huruf kapital tanpa disingkat') !!}
    {!! Form::text('asal_instansi_detail', null, ['class' => 'form-control', 'maxlength' => 255, 'placeholder' => 'contoh: KELURAHAN LOA IPUH']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('tujuan_instansi', 'Tujuan Instansi \ Perangkat Daerah:') !!}
    {!! Form::select('tujuan_instansi', $perangkatDaerahs, null, [
        'class' => 'form-control',
        'placeholder' => 'Pilih Instansi',
        'required',
    ]) !!}
</div>

<!-- tujuan_instansi_detail -->
<div class="form-group col-sm-6">
    {!! Form::label('tujuan_instansi_detail', 'Unit kerja/Bidang/Kelurahan (Tujuan) menggunakan huruf kapital tanpa disingkat') !!}
    {!! Form::text('tujuan_instansi_detail', null, ['class' => 'form-control', 'maxlength' => 255, 'placeholder' => 'contoh: KELURAHAN LOA IPUH']) !!}
</div>

<!-- Alasan Mutasi Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('alasan_mutasi', 'Alasan Mutasi:') !!}
    {!! Form::textarea('alasan_mutasi', null, [
        'class' => 'form-control',
        'maxlength' => 65535,
        'required',
    ]) !!}
</div>


<div class="form-group col-sm-6">
    {!! Form::label('surat_pengantar', 'Surat Pengantar:') !!}
    @if ($isUpdatePage)
        <x-media-library-collection :model="$pendaftaranMutasi" name="surat_pengantar" collection="surat_pengantar"
            rules="mimes:pdf" maxFiles="1" />
    @else
        <x-media-library-attachment name="surat_pengantar" rules="mimes:pdf" maxFiles="1" required />
    @endif
</div>

<div class="form-group col-sm-6">
    {!! Form::label('surat_permohonan_pindah', 'Surat Permohonan Pindah ASN') !!}
    @if ($isUpdatePage)
        <x-media-library-collection :model="$pendaftaranMutasi" name="surat_permohonan_pindah"
            collection="surat_permohonan_pindah" rules="mimes:pdf" maxFiles="1" />
    @else
        <x-media-library-attachment name="surat_permohonan_pindah" rules="mimes:pdf" maxFiles="1" required />
    @endif
</div>

<div class="form-group col-sm-6">
    {!! Form::label('sk_kenaikan_pangkat', 'SK Kenaikan Pangkat/SK Jabatan Terakhir di Legalisir') !!}
    @if ($isUpdatePage)
        <x-media-library-collection :model="$pendaftaranMutasi" name="sk_kenaikan_pangkat" collection="sk_kenaikan_pangkat"
            rules="mimes:pdf" maxFiles="1" />
    @else
        <x-media-library-attachment name="sk_kenaikan_pangkat" rules="mimes:pdf" maxFiles="1" required />
    @endif
</div>

<div class="form-group col-sm-6">
    {!! Form::label('rekomendasi_menerima_anjab', 'Rekomendasi Menerima dan Anjab') !!}

    @if ($isUpdatePage)
        <x-media-library-collection :model="$pendaftaranMutasi" name="rekomendasi_menerima_anjab"
            collection="rekomendasi_menerima_anjab" rules="mimes:pdf" maxFiles="1" />
    @else
        <x-media-library-attachment name="rekomendasi_menerima_anjab" rules="mimes:pdf" maxFiles="1" required />
    @endif
</div>

<div class="form-group col-sm-6">
    {!! Form::label('rekomendasi_melepas_anjab', 'Rekomendasi Melepas dan Anjab') !!}
    @if ($isUpdatePage)
        <x-media-library-collection :model="$pendaftaranMutasi" name="rekomendasi_melepas_anjab"
            collection="rekomendasi_melepas_anjab" rules="mimes:pdf" maxFiles="1" />
    @else
        <x-media-library-attachment name="rekomendasi_melepas_anjab" rules="mimes:pdf" maxFiles="1" required />
    @endif
</div>

<div class="form-group col-sm-6">
    {!! Form::label('surat_skp', 'Foto Copy SKP 1 Tahun Terakhir di Legalisir') !!}
    @if ($isUpdatePage)
        <x-media-library-collection :model="$pendaftaranMutasi" name="surat_skp" collection="surat_skp" rules="mimes:pdf"
            maxFiles="1" />
    @else
        <x-media-library-attachment name="surat_skp" rules="mimes:pdf" maxFiles="1" required />
    @endif

</div>

<div class="form-group col-sm-12">
    {!! Form::label('jenis_instansi', 'Jenis Instansi') !!}
    <select id="instansi-select" name="jenis_instansi" class="form-control" onchange="showContent()">
        <option value="umum">Umum</option>
        <option value="kesehatan">JF Kesehatan</option>
        <option value="pendidikan">JF Pendidikan</option>
    </select>
    @if ($isUpdatePage)
        <script>
            document.getElementById('instansi-select').value = '{{ $pendaftaranMutasi->jenis_instansi }}';
        </script>
    @endif
</div>


<div class="form-group col-sm-6 jenis-instansi-kesehatan" style="display: none;">
    {!! Form::label('persetujuan_dinas_kesehatan', 'Persetujuan/Rekomendasi dari Dinas kesehatan') !!}
    @if ($isUpdatePage)
        <x-media-library-collection :model="$pendaftaranMutasi" name="persetujuan_dinas_kesehatan"
            collection="persetujuan_dinas_kesehatan" rules="mimes:pdf" maxFiles="1" />
    @else
        <x-media-library-attachment name="persetujuan_dinas_kesehatan" rules="mimes:pdf" maxFiles="1" required />
    @endif
</div>

<div class="form-group col-sm-6 jenis-instansi-kesehatan" style="display: none;">
    {!! Form::label('rekomendasi_upt', 'Rekomendasi Dari UPT.Dinas kesehatan Puskesmas dan Anjab') !!}
    @if ($isUpdatePage)
        <x-media-library-collection :model="$pendaftaranMutasi" name="rekomendasi_upt" collection="rekomendasi_upt"
            rules="mimes:pdf" maxFiles="1" />
    @else
        <x-media-library-attachment name="rekomendasi_upt" rules="mimes:pdf" maxFiles="1" required />
    @endif
</div>

<div class="form-group col-sm-6 jenis-instansi-pendidikan" style="display: none;">
    {!! Form::label(
        'persetujuan_dinas_pendidikan',
        ' Persetujuan/Rekomendasi dari Dinas pendidikan dan Kebudayaan Kabupaten :',
    ) !!}
    @if ($isUpdatePage)
        <x-media-library-collection :model="$pendaftaranMutasi" name="persetujuan_dinas_pendidikan"
            collection="persetujuan_dinas_pendidikan" rules="mimes:pdf" maxFiles="1" />
    @else
        <x-media-library-attachment name="persetujuan_dinas_pendidikan" rules="mimes:pdf" maxFiles="1" required />
    @endif
</div>

<div class="form-group col-sm-6 jenis-instansi-pendidikan" style="display: none;">
    {!! Form::label(
        'persetujuan_kepala_cabang_dinas',
        ' Persetujuan/Rekomendasi dari Kepala Cabang Dinas Kecamatan :',
    ) !!}
    @if ($isUpdatePage)
        <x-media-library-collection :model="$pendaftaranMutasi" name="persetujuan_kepala_cabang_dinas"
            collection="persetujuan_kepala_cabang_dinas" rules="mimes:pdf" maxFiles="1" />
    @else
        <x-media-library-attachment name="persetujuan_kepala_cabang_dinas" rules="mimes:pdf" maxFiles="1"
            required />
    @endif
</div>

<div class="form-group col-sm-6 jenis-instansi-pendidikan" style="display: none;">
    {!! Form::label('rekomendasi_kepsek_menerima', 'Rekomendasi kepala Sekolah yang menerima Asli :') !!}
    @if ($isUpdatePage)
        <x-media-library-collection :model="$pendaftaranMutasi" name="rekomendasi_kepsek_menerima"
            collection="rekomendasi_kepsek_menerima" rules="mimes:pdf" maxFiles="1" />
    @else
        <x-media-library-attachment name="rekomendasi_kepsek_menerima" rules="mimes:pdf" maxFiles="1" required />
    @endif
</div>

<div class="form-group col-sm-6 jenis-instansi-pendidikan" style="display: none;">
    {!! Form::label('rekomendasi_kepsek_melepas', 'Rekomendasi kepala Sekolah yang melepas Asli') !!}
    @if ($isUpdatePage)
        <x-media-library-collection :model="$pendaftaranMutasi" name="rekomendasi_kepsek_melepas"
            collection="rekomendasi_kepsek_melepas" rules="mimes:pdf" maxFiles="1" />
    @else
        <x-media-library-attachment name="rekomendasi_kepsek_melepas" rules="mimes:pdf" maxFiles="1" required />
    @endif
</div>

<div class="form-group col-sm-6 jenis-instansi-pendidikan" style="display: none;">
    {!! Form::label('data_keadan_guru', ' Data Keadaan Guru (DKG)di 2 Sekolah Asli') !!}
    @if ($isUpdatePage)
        <x-media-library-collection :model="$pendaftaranMutasi" name="data_keadan_guru" collection="data_keadan_guru"
            rules="mimes:pdf" maxFiles="1" />
    @else
        <x-media-library-attachment name="data_keadan_guru" rules="mimes:pdf" maxFiles="1" required />
    @endif
</div>


<script>
    function showContent() {
        var select = document.getElementById("instansi-select");
        var jenisKesehatan = document.getElementsByClassName("jenis-instansi-kesehatan");
        var jenisPendidikan = document.getElementsByClassName("jenis-instansi-pendidikan");

        var selectedValue = select.value;

        // Sembunyikan semua elemen dengan kelas tertentu terlebih dahulu
        for (var i = 0; i < jenisKesehatan.length; i++) {
            jenisKesehatan[i].style.display = "none";
        }
        for (var i = 0; i < jenisPendidikan.length; i++) {
            jenisPendidikan[i].style.display = "none";
        }

        // Tampilkan elemen berdasarkan kelas dan pilihan dropdown
        if (selectedValue === "kesehatan") {
            for (var i = 0; i < jenisKesehatan.length; i++) {
                jenisKesehatan[i].style.display = "block";
            }
        } else if (selectedValue === "pendidikan") {
            for (var i = 0; i < jenisPendidikan.length; i++) {
                jenisPendidikan[i].style.display = "block";
            }
        }
    }
    // jalankan fungsi untuk pertama kali
    window.onload = showContent;
</script>
