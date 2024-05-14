@extends('layouts.app')

@section('content')

    <div class="content-body">
        <section id="horizontal-form-layouts">
            <div class="row">
                <div class="col-md-12">
                    <div class="card overflow-hidden">
                        <div class="card-content">
                            <div class="media align-items-stretch">
                                <div class="bg-green p-2 media-middle">
                                    <i class="fa fa-pencil-square font-large-2 text-white"></i>
                                </div>
                                <div class="media-body p-1">
                                    <span class="green font-medium-5">Input Pendaftaran Mutasi</span><br>
                                    <span style="margin-top: -5px">Membuat Pendaftaran Mutasi Baru</span>
                                    @include('flash::message')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    @include('adminlte-templates::common.errors')
                    <div class="card">
                        <div class="card-content collpase show">
                            <div class="card-body">

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
                                    {!! Form::label('surat_pengantar', 'Surat Pengantar:') !!}
                                    @if ($pendaftaranMutasi->hasMedia('surat_pengantar'))
                                        <ul>
                                            @foreach ($pendaftaranMutasi->getMedia('surat_pengantar') as $media)
                                                <li>
                                                    <a class="btn btn-dark" href="{{ $media->getUrl() }}"
                                                        target="_blank">Download</a>
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
                                                    <a class="btn btn-dark" href="{{ $media->getUrl() }}"
                                                        target="_blank">Download</a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @else
                                        <p> - Belum ada file</p>
                                    @endif
                                </div>

                                <div class="col-sm-12">
                                    {!! Form::label('sk_kenaikan_pangkat', 'SK Kenaikan Pangkat/SK Jabatan Terakhir:') !!}
                                    @if ($pendaftaranMutasi->hasMedia('sk_kenaikan_pangkat'))
                                        <ul>
                                            @foreach ($pendaftaranMutasi->getMedia('sk_kenaikan_pangkat') as $media)
                                                <a class="btn btn-dark" href="{{ $media->getUrl() }}"
                                                    target="_blank">Download</a>
                                            @endforeach
                                        </ul>
                                    @else
                                        <p> - Belum ada file</p>
                                    @endif
                                </div>

                                <div class="col-sm-12">
                                    {{-- {!! Form::label('rekomendasi_menerima_anjab', 'Rekomendasi Menerima dan Anjab:') !!} --}}
                                    {!! Form::label('rekomendasi_menerima_anjab', 'Rekomendasi Menerima dan ABK:') !!}
                                    @if ($pendaftaranMutasi->hasMedia('rekomendasi_menerima_anjab'))
                                        <ul>
                                            @foreach ($pendaftaranMutasi->getMedia('rekomendasi_menerima_anjab') as $media)
                                                <a class="btn btn-dark" href="{{ $media->getUrl() }}"
                                                    target="_blank">Download</a>
                                            @endforeach
                                        </ul>
                                    @else
                                        <p> - Belum ada file</p>
                                    @endif
                                </div>

                                <div class="col-sm-12">
                                    {{-- {!! Form::label('rekomendasi_melepas_anjab', 'Rekomendasi Melepas dan Anjab:') !!} --}}
                                    {!! Form::label('rekomendasi_melepas_anjab', 'Rekomendasi Melepas dan ABK:') !!}
                                    @if ($pendaftaranMutasi->hasMedia('rekomendasi_melepas_anjab'))
                                        <ul>
                                            @foreach ($pendaftaranMutasi->getMedia('rekomendasi_melepas_anjab') as $media)
                                                <a class="btn btn-dark" href="{{ $media->getUrl() }}"
                                                    target="_blank">Download</a>
                                            @endforeach
                                        </ul>
                                    @else
                                        <p> - Belum ada file</p>
                                    @endif
                                </div>

                                <div class="col-sm-12">
                                    {!! Form::label('surat_skp', 'Foto Copy SKP 1 Tahun Terakhir:') !!}
                                    @if ($pendaftaranMutasi->hasMedia('surat_skp'))
                                        <ul>
                                            @foreach ($pendaftaranMutasi->getMedia('surat_skp') as $media)
                                                <a class="btn btn-dark" href="{{ $media->getUrl() }}"
                                                    target="_blank">Download</a>
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
                                                    <a class="btn btn-dark" href="{{ $media->getUrl() }}"
                                                        target="_blank">Download</a>
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
                                                    <a class="btn btn-dark" href="{{ $media->getUrl() }}"
                                                        target="_blank">Download</a>
                                                @endforeach
                                            </ul>
                                        @else
                                            <p> - Belum ada file</p>
                                        @endif
                                    </div>

                                @endif

                                @if ($pendaftaranMutasi->tujuanInstansi->jenis_instansi == 'pendidikan')

                                    <div class="col-sm-12">
                                        {!! Form::label(
                                            'persetujuan_dinas_pendidikan',
                                            ' Persetujuan/Rekomendasi dari Dinas pendidikan dan Kebudayaan Kabupaten:',
                                        ) !!}
                                        @if ($pendaftaranMutasi->hasMedia('persetujuan_dinas_pendidikan'))
                                            <ul>
                                                @foreach ($pendaftaranMutasi->getMedia('persetujuan_dinas_pendidikan') as $media)
                                                    <a class="btn btn-dark" href="{{ $media->getUrl() }}"
                                                        target="_blank">Download</a>
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
                                                    <a class="btn btn-dark" href="{{ $media->getUrl() }}"
                                                        target="_blank">Download</a>
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
                                                    <a class="btn btn-dark" href="{{ $media->getUrl() }}"
                                                        target="_blank">Download</a>
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
                                                    <a class="btn btn-dark" href="{{ $media->getUrl() }}"
                                                        target="_blank">Download</a>
                                                @endforeach
                                            </ul>
                                        @else
                                            <p> - Belum ada file</p>
                                        @endif
                                    </div>

                                    <div class="col-sm-12">
                                        {!! Form::label(
                                            'data_keadan_guru',
                                            'Data Keadaan Guru (DKG)di 2 Sekolah Asli Rekomendasi kepala Sekolah yang melepas Asli :',
                                        ) !!}
                                        @if ($pendaftaranMutasi->hasMedia('data_keadan_guru'))
                                            <ul>
                                                @foreach ($pendaftaranMutasi->getMedia('data_keadan_guru') as $media)
                                                    <a class="btn btn-dark" href="{{ $media->getUrl() }}"
                                                        target="_blank">Download</a>
                                                @endforeach
                                            </ul>
                                        @else
                                            <p> - Belum ada file</p>
                                        @endif
                                    </div>
                                @endif


                                {!! Form::open(['route' => 'reviewConfirm', 'files' => true]) !!}
                                <input type="hidden" name="pendaftaran_mutasi_id" value="{{ $pendaftaranMutasi->id }}">
                                <div class="form-body row">
                                    <div class="form-actions center col-md-12">
                                        {!! Form::label('message', 'Pesan Penolakan / Revisi /Persetujuan:') !!}
                                        {!! Form::textarea('message', null, ['class' => 'form-control mb-1', 'maxlength' => 65535]) !!}
                                        {!! Form::label('lampiran', 'Lampiran: (kosongkan jika tidak perlu)') !!}
                                        <x-media-library-attachment name="lampiran" rules="mimes:pdf" maxFiles="1" required />

                                        <a href="{{ route('pendaftaranMutasis.index') }}" class="btn btn-default mt-2">Kembali</a>

                                        <button type="submit" class="btn btn-primary mt-2" name="ditolak_button">Di Tolak</button>
                                        <button type="submit" class="btn btn-dark mt-2" name="revisi_button">Revisi</button>
                                        <button type="submit" class="btn btn-success mt-2" name="disetujui_button">Di Setujui</button>
                                    </div>
                                </div>
                                {!! Form::close() !!}

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
