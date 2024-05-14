<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePendaftaranMutasiRequest;
use App\Http\Requests\UpdatePendaftaranMutasiRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\PendaftaranMutasiRepository;
use Illuminate\Http\Request;
use App\Models\Status;
use App\Models\Pegawai;
use App\Models\Pangkat;
use App\Models\PangkatGolongan;
use App\Models\PerangkatDaerah;
use App\Models\PendaftaranMutasi;
use App\Models\PendaftaranMutasiStatus;
use App\Imports\PendaftaranMutasiImport;
use Auth;
use DB;
use Spatie\MediaLibraryPro\Models\TemporaryUpload;
use Flash;
use Excel;

class PendaftaranMutasiController extends AppBaseController
{
    /** @var PendaftaranMutasiRepository $pendaftaranMutasiRepository*/
    private $pendaftaranMutasiRepository;

    public function __construct(PendaftaranMutasiRepository $pendaftaranMutasiRepo)
    {
        $this->middleware('permission:pendaftaranMutasis.index', ['only' => ['index','show']]);
        $this->middleware('permission:pendaftaranMutasis.create', ['only' => ['create','store']]);
        $this->middleware('permission:pendaftaranMutasis.edit', ['only' => ['edit','update']]);
        $this->middleware('permission:pendaftaranMutasis.destroy', ['only' => ['destroy']]);
        $this->pendaftaranMutasiRepository = $pendaftaranMutasiRepo;
    }

    public function index(Request $request)
    {
        $user = Auth::user();
        if ($user->hasRole(['admin','super-admin'])) {
            $pendaftaranMutasis = PendaftaranMutasi::whereHas('pendaftaranMutasiStatuses.statusMutasi', function ($query) {
                $query->where('nama', 'Proses');
            })->whereDoesntHave('pendaftaranMutasiStatuses.statusMutasi', function ($query) {
                $query->where('nama', 'Ditolak')->orWhere('nama', 'Disetujui');
            })->orderBy('created_at', 'desc')->paginate(10);            
        }else{
            $pendaftaranMutasis = $user->pegawai->pendaftaranMutasis()->orderBy('created_at', 'desc')->paginate(10);
        }

        foreach ($pendaftaranMutasis as $pendaftaranMutasi) {
            $pendaftaranMutasi['status'] = $pendaftaranMutasi
            ->pendaftaranMutasiStatuses
            ->last()
            ?->statusMutasi
            ?->nama;
        }
        
        return view('pendaftaran_mutasis.index')->with('pendaftaranMutasis', $pendaftaranMutasis);
    }
    
    public function keputusanMutasi(Request $request)
    {
        $pendaftaranMutasis = PendaftaranMutasi::whereHas('pendaftaranMutasiStatuses.statusMutasi', function ($query) {
            $query->where('nama', 'Disetujui')->orWhere('nama', 'Ditolak');
        })->orderBy('created_at', 'desc')->paginate(10);

        foreach ($pendaftaranMutasis as $pendaftaranMutasi) {
            $pendaftaranMutasi['status'] = $pendaftaranMutasi
            ->pendaftaranMutasiStatuses
            ->last()
            ?->statusMutasi
            ?->nama;
        }
        
        return view('pendaftaran_mutasis.keputusan_mutasi')->with('pendaftaranMutasis', $pendaftaranMutasis);
    }

    public function create()
    {
        $isUpdatePage = false;
        $pegawaiData = Pegawai::with('user')->get();
        $perangkatDaerahs = PerangkatDaerah::pluck('nama','id');

        $perangkatDaerahAsal =  Auth::user()->pegawai->perangkatDaerah;
        $pegawaiSekarang = Auth::user()->pegawai;
        $pangkats = Pangkat::pluck('nama','id');
        $pangkatGolongans = PangkatGolongan::pluck('name','id');
        return view('pendaftaran_mutasis.create', compact('perangkatDaerahs', 'isUpdatePage','pegawaiData','perangkatDaerahAsal','pegawaiSekarang','pangkats','pangkatGolongans'));
    }

    public function store(CreatePendaftaranMutasiRequest $request)
    {
        $input = $request->all();

        if (!Auth::user()->hasRole(['admin','super-admin'])) {
            $input['pegawai_id'] = Auth::user()->pegawai->id;
        }

        if ($input['asal_instansi'] === $input['tujuan_instansi']) {
            Flash::error('Asal instansi dan tujuan instansi tidak boleh sama');
            return redirect(route('pendaftaranMutasis.create'));
        }

        if ($request->has('ajukan_button')) {
            $input['tanggal_masuk_berkas'] = date('Y-m-d');
            $requiredMediaFields = ['surat_pengantar', 'surat_permohonan_pindah', 'sk_kenaikan_pangkat', 'rekomendasi_menerima_anjab', 'rekomendasi_melepas_anjab', 'surat_skp'];

            // jika jenis_instansi tujuan kesehatan
            if ($request->jenis_instansi == 'kesehatan') {
                array_push($requiredMediaFields, 'persetujuan_dinas_kesehatan', 'rekomendasi_upt');
            }

            // jika jenis_instansi tujuan pendidikan
            if ($request->jenis_instansi == 'pendidikan') {
                array_push($requiredMediaFields, 'persetujuan_dinas_pendidikan', 'persetujuan_kepala_cabang_dinas', 'rekomendasi_kepsek_menerima', 'rekomendasi_kepsek_melepas', 'data_keadan_guru');
            }
            
            foreach ($requiredMediaFields as $field) {
                if (!isset($request->$field)) {
                    Flash::error('Media ' . $field . ' tidak boleh kosong.');
                    return redirect(route('pendaftaranMutasis.create'));
                }
            }
        }

        DB::transaction(function () use($input,$request) {
            $pendaftaranMutasi = $this->pendaftaranMutasiRepository->create($input);
            
            $pegawai = $pendaftaranMutasi->pegawai;
            $pegawai->pangkat_id = $request->pangkat_id;
            $pegawai->pangkat_golongan_id = $request->pangkat_golongan_id;
            $pegawai->perangkat_daerah_id = $pendaftaranMutasi->asal_instansi;
            $pegawai->save();

            $user = $pegawai->user;
            
            if ($request->has('save_button')) {
                PendaftaranMutasiStatus::create([
                    'pendaftaran_mutasi_id' => $pendaftaranMutasi->id,
                    'status_mutasi_id' => Status::where('nama', 'Draft')->first()->id,
                    'approved_by' => Auth::user()->id,
                    'message' => 'Draft pendaftaran mutasi dibuat'
                ]);
            } 
    
            if ($request->has('ajukan_button')) {
                PendaftaranMutasiStatus::create([
                    'pendaftaran_mutasi_id' => $pendaftaranMutasi->id,
                    'status_mutasi_id' => Status::where('nama', 'Proses')->first()->id,
                    'approved_by' => Auth::user()->id,
                    'message' => 'Pendaftaran mutasi Di Ajukan, Menunggu tindakan ',
                ]);
            }

            if(isset($request->surat_pengantar)){
                $pendaftaranMutasi->addFromMediaLibraryRequest($request->surat_pengantar)
                    ->usingName($user->name . ' - Surat Pengantar')
                    ->toMediaCollection('surat_pengantar');
            }

            if(isset($request->surat_permohonan_pindah)){
                $pendaftaranMutasi->addFromMediaLibraryRequest($request->surat_permohonan_pindah)
                    ->usingName($user->name . ' - Surat Permohonan Pindah')
                    ->toMediaCollection('surat_permohonan_pindah');
            }

            if(isset($request->sk_kenaikan_pangkat)){
                $pendaftaranMutasi->addFromMediaLibraryRequest($request->sk_kenaikan_pangkat)
                    ->usingName($user->name . ' - SK Kenaikan Pangkat')
                    ->toMediaCollection('sk_kenaikan_pangkat');
            }

            if(isset($request->rekomendasi_menerima_anjab)){
                $pendaftaranMutasi->addFromMediaLibraryRequest($request->rekomendasi_menerima_anjab)
                    ->usingName($user->name . ' - Rekomendasi Menerima Anjab')
                    ->toMediaCollection('rekomendasi_menerima_anjab');
            }

            if(isset($request->rekomendasi_melepas_anjab)){
                $pendaftaranMutasi->addFromMediaLibraryRequest($request->rekomendasi_melepas_anjab)
                    ->usingName($user->name . ' - Rekomendasi Melepas Anjab')
                    ->toMediaCollection('rekomendasi_melepas_anjab');
            }

            if(isset($request->surat_skp)){
                $pendaftaranMutasi->addFromMediaLibraryRequest($request->surat_skp)
                    ->usingName($user->name . ' - Surat SKP')
                    ->toMediaCollection('surat_skp');
            }

            if ($pendaftaranMutasi->tujuanInstansi->jenis_instansi == 'kesehatan' ) {
                if(isset($request->persetujuan_dinas_kesehatan)){
                    $pendaftaranMutasi->addFromMediaLibraryRequest($request->persetujuan_dinas_kesehatan)
                        ->usingName($user->name . ' - Persetujuan Dinas Kesehatan')
                        ->toMediaCollection('persetujuan_dinas_kesehatan');
                }

                if(isset($request->rekomendasi_upt)){
                    $pendaftaranMutasi->addFromMediaLibraryRequest($request->rekomendasi_upt)
                        ->usingName($user->name . ' - Rekomendasi UPT')
                        ->toMediaCollection('rekomendasi_upt');
                }
            }

            if ($pendaftaranMutasi->tujuanInstansi->jenis_instansi == 'pendidikan' ) {
                if(isset($request->persetujuan_dinas_pendidikan)){
                    $pendaftaranMutasi->addFromMediaLibraryRequest($request->persetujuan_dinas_pendidikan)
                        ->usingName($user->name . ' - Persetujuan Dinas Pendidikan')
                        ->toMediaCollection('persetujuan_dinas_pendidikan');
                }
                if(isset($request->persetujuan_kepala_cabang_dinas)){
                    $pendaftaranMutasi->addFromMediaLibraryRequest($request->persetujuan_kepala_cabang_dinas)
                        ->usingName($user->name . ' - Persetujuan Kepala Cabang Dinas')
                        ->toMediaCollection('persetujuan_kepala_cabang_dinas');
                }
                if(isset($request->rekomendasi_kepsek_menerima)){
                    $pendaftaranMutasi->addFromMediaLibraryRequest($request->rekomendasi_kepsek_menerima)
                        ->usingName($user->name . ' - Rekomendasi Kepala Sekolah Menerima')
                        ->toMediaCollection('rekomendasi_kepsek_menerima');
                }
                if(isset($request->rekomendasi_kepsek_melepas)){
                    $pendaftaranMutasi->addFromMediaLibraryRequest($request->rekomendasi_kepsek_melepas)
                        ->usingName($user->name . ' - Rekomendasi Kepala Sekolah Melepas')
                        ->toMediaCollection('rekomendasi_kepsek_melepas');
                }
                if(isset($request->data_keadan_guru)){
                    $pendaftaranMutasi->addFromMediaLibraryRequest($request->data_keadan_guru)
                        ->usingName($user->name . ' - Data Keadan Guru')
                        ->toMediaCollection('data_keadan_guru');
                }
            }
        },3);

        Flash::success('Pendaftaran Mutasi saved successfully.');
        return redirect(route('pendaftaranMutasis.index'));
    }

    public function show($id)
    {
        $pendaftaranMutasi = $this->pendaftaranMutasiRepository->find($id);

        if (empty($pendaftaranMutasi)) {
            Flash::error('Pendaftaran Mutasi not found');
            return redirect(route('pendaftaranMutasis.index'));
        }

        return view('pendaftaran_mutasis.show')->with('pendaftaranMutasi', $pendaftaranMutasi);
    }

    public function timeline($id)
    {
        $pendaftaranMutasi = $this->pendaftaranMutasiRepository->find($id);

        if (empty($pendaftaranMutasi)) {
            Flash::error('Pendaftaran Mutasi not found');
            return redirect(route('pendaftaranMutasis.index'));
        }

        foreach ($pendaftaranMutasi->pendaftaranMutasiStatuses as $pendaftaranMutasiStatuse) {
            $pendaftaranMutasiStatuse->statusMutasi;
        }   

        return view('pendaftaran_mutasis.timeline')->with('pendaftaranMutasi', $pendaftaranMutasi);
    }

    public function review($id)
    {
        $pendaftaranMutasi = $this->pendaftaranMutasiRepository->find($id);

        if (empty($pendaftaranMutasi)) {
            Flash::error('Pendaftaran Mutasi not found');
            return redirect(route('pendaftaranMutasis.index'));
        }

        return view('pendaftaran_mutasis.review')->with('pendaftaranMutasi', $pendaftaranMutasi);
    }

    public function reviewConfirm(Request $request)
    {
        $pendaftaranMutasi = $this->pendaftaranMutasiRepository->find($request->pendaftaran_mutasi_id);

        if (empty($pendaftaranMutasi)) {
            Flash::error('Pendaftaran Mutasi not found');
            return redirect(route('pendaftaranMutasis.index'));
        }

        DB::transaction(function () use($pendaftaranMutasi,$request) {
            if ($request->has('ditolak_button')) {
                $pendaftaranMutasiStatus = PendaftaranMutasiStatus::create([
                    'pendaftaran_mutasi_id' => $pendaftaranMutasi->id,
                    'status_mutasi_id' => Status::where('nama', 'Ditolak')->first()->id,
                    'approved_by' => Auth::user()->id,
                    'message' => $request->message,
                ]);
                Flash::success('Pendaftaran Mutasi ditolak.');
            }

            if ($request->has('revisi_button')) {
                $pendaftaranMutasiStatus = PendaftaranMutasiStatus::create([
                    'pendaftaran_mutasi_id' => $pendaftaranMutasi->id,
                    'status_mutasi_id' => Status::where('nama', 'Revisi')->first()->id,
                    'approved_by' => Auth::user()->id,
                    'message' => $request->message,
                ]);
                Flash::success('Pendaftaran Mutasi diminta Untuk Ditinjau Kembali Kepada Pemohon.');
            }
    
            if ($request->has('disetujui_button')) {
                $pendaftaranMutasiStatus = PendaftaranMutasiStatus::create([
                    'pendaftaran_mutasi_id' => $pendaftaranMutasi->id,
                    'status_mutasi_id' => Status::where('nama', 'Disetujui')->first()->id,
                    'approved_by' => Auth::user()->id,
                    'message' => $request->message,
                ]);

                $pegawai = $pendaftaranMutasi->pegawai;
                $pegawai->perangkat_daerah_id = $pendaftaranMutasi->tujuan_instansi;
                $pegawai->save();

                Flash::success('Pendaftaran Mutasi Success.');
            } 

            // if(isset($request->lampiran)){
            //     $pendaftaranMutasi->addFromMediaLibraryRequest($request->lampiran)->toMediaCollection('lampiran');
            // }

            // berkas timeline seharusnya bukan di pendaftaranMutasi tapi di pendaftaranMutasiStatus
            if(isset($request->lampiran)){
                $pendaftaranMutasiStatus->addFromMediaLibraryRequest($request->lampiran)->toMediaCollection('lampiran');
            }

        },3);

        return redirect(route('pendaftaranMutasis.index'));
    }

    public function edit($id)
    {
        $pendaftaranMutasi = $this->pendaftaranMutasiRepository->find($id);

        if (empty($pendaftaranMutasi)) {
            Flash::error('Pendaftaran Mutasi not found');
            return redirect(route('pendaftaranMutasis.index'));
        }

        $isUpdatePage = true;
        $perangkatDaerahs = PerangkatDaerah::pluck('nama','id');
        $pegawais = [];
        $pegawaiSekarang = $pendaftaranMutasi->pegawai;
        $pangkats = Pangkat::pluck('nama','id');
        $pangkatGolongans = PangkatGolongan::pluck('name','id');

        return view('pendaftaran_mutasis.edit', compact('perangkatDaerahs','pegawais', 'pendaftaranMutasi', 'isUpdatePage','pegawaiSekarang','pangkats','pangkatGolongans'));
    }

    /**
     * Update the specified PendaftaranMutasi in storage.
     */
    public function update($id, UpdatePendaftaranMutasiRequest $request)
    {
        $pendaftaranMutasi = $this->pendaftaranMutasiRepository->find($id);

        if (empty($pendaftaranMutasi)) {
            Flash::error('Pendaftaran Mutasi not found');
            return redirect(route('pendaftaranMutasis.index'));
        }

        if ($request->has('ajukan_button')) {
            $requiredMediaFields = ['surat_pengantar', 'surat_permohonan_pindah', 'sk_kenaikan_pangkat', 'rekomendasi_menerima_anjab', 'rekomendasi_melepas_anjab', 'surat_skp'];

            // jika jenis_instansi tujuan kesehatan
            if ($request->jenis_instansi == 'kesehatan') {
                array_push($requiredMediaFields, 'persetujuan_dinas_kesehatan', 'rekomendasi_upt');
            }

            // jika jenis_instansi tujuan pendidikan
            if ($request->jenis_instansi == 'pendidikan') {
                array_push($requiredMediaFields, 'persetujuan_dinas_pendidikan', 'persetujuan_kepala_cabang_dinas', 'rekomendasi_kepsek_menerima', 'rekomendasi_kepsek_melepas', 'data_keadan_guru');
            }
            
            foreach ($requiredMediaFields as $field) {
                if (!isset($request->$field)) {
                    Flash::error('File ' . $field . ' Wajib Di isi.');
                    return redirect(route('pendaftaranMutasis.edit', $id));
                }
            }
        }

        DB::transaction(function () use($id,$request,$pendaftaranMutasi) {
            $pegawai = $pendaftaranMutasi->pegawai;
            $pegawai->pangkat_id = $request->pangkat_id;
            $pegawai->pangkat_golongan_id = $request->pangkat_golongan_id;
            $pegawai->perangkat_daerah_id = $pendaftaranMutasi->asal_instansi;
            $pegawai->save();

            $input = $request->all();

            if ($input['asal_instansi'] === $input['tujuan_instansi']) {
                Flash::error('Asal instansi dan tujuan instansi tidak boleh sama');
                return redirect(route('pendaftaranMutasis.edit'));
            }

            unset($input['pegawai_id']);

            $pendaftaranMutasi = $this->pendaftaranMutasiRepository->update($input, $id);

            if (isset($request->surat_pengantar)) {
                $pendaftaranMutasi->syncFromMediaLibraryRequest($request->surat_pengantar)->toMediaCollection('surat_pengantar');
            }   
            if (isset($request->surat_permohonan_pindah)) {
                $pendaftaranMutasi->syncFromMediaLibraryRequest($request->surat_permohonan_pindah)->toMediaCollection('surat_permohonan_pindah');
            }        
            if (isset($request->sk_kenaikan_pangkat)) {
                $pendaftaranMutasi->syncFromMediaLibraryRequest($request->sk_kenaikan_pangkat)->toMediaCollection('sk_kenaikan_pangkat');
            }        
            if (isset($request->rekomendasi_menerima_anjab)) {
                $pendaftaranMutasi->syncFromMediaLibraryRequest($request->rekomendasi_menerima_anjab)->toMediaCollection('rekomendasi_menerima_anjab');
            }        
            if (isset($request->rekomendasi_melepas_anjab)) {
                $pendaftaranMutasi->syncFromMediaLibraryRequest($request->rekomendasi_melepas_anjab)->toMediaCollection('rekomendasi_melepas_anjab');
            }        
            if (isset($request->surat_skp)) {
                $pendaftaranMutasi->syncFromMediaLibraryRequest($request->surat_skp)->toMediaCollection('surat_skp');
            }
            if ($pendaftaranMutasi->tujuanInstansi->jenis_instansi == 'kesehatan' ) {
                
                if(isset($request->persetujuan_dinas_kesehatan)){
                    $pendaftaranMutasi->syncFromMediaLibraryRequest($request->persetujuan_dinas_kesehatan)->toMediaCollection('persetujuan_dinas_kesehatan');
                }

                if(isset($request->rekomendasi_upt)){
                    $pendaftaranMutasi->syncFromMediaLibraryRequest($request->rekomendasi_upt)->toMediaCollection('rekomendasi_upt');
                }
            }

            if ($pendaftaranMutasi->tujuanInstansi->jenis_instansi == 'pendidikan' ) {
                if(isset($request->persetujuan_dinas_pendidikan)){
                    $pendaftaranMutasi->syncFromMediaLibraryRequest($request->persetujuan_dinas_pendidikan)->toMediaCollection('persetujuan_dinas_pendidikan');
                }
                if(isset($request->persetujuan_kepala_cabang_dinas)){
                    $pendaftaranMutasi->syncFromMediaLibraryRequest($request->persetujuan_kepala_cabang_dinas)->toMediaCollection('persetujuan_kepala_cabang_dinas');
                }
                if(isset($request->rekomendasi_kepsek_menerima)){
                    $pendaftaranMutasi->syncFromMediaLibraryRequest($request->rekomendasi_kepsek_menerima)->toMediaCollection('rekomendasi_kepsek_menerima');
                }
                if(isset($request->rekomendasi_kepsek_melepas)){
                    $pendaftaranMutasi->syncFromMediaLibraryRequest($request->rekomendasi_kepsek_melepas)->toMediaCollection('rekomendasi_kepsek_melepas');
                }
                if(isset($request->data_keadan_guru)){
                    $pendaftaranMutasi->syncFromMediaLibraryRequest($request->data_keadan_guru)->toMediaCollection('data_keadan_guru');
                }
            }

            if ($request->has('save_button')) {
                PendaftaranMutasiStatus::create([
                    'pendaftaran_mutasi_id' => $pendaftaranMutasi->id,
                    'status_mutasi_id' => Status::where('nama', 'Draft')->first()->id,
                    'approved_by' => Auth::user()->id,
                    'message' => 'Draft diperbarui'
                ]);
            } 
            
            if ($request->has('ajukan_button')) {
                $pendaftaranMutasi->tanggal_masuk_berkas = date('Y-m-d');
                $pendaftaranMutasi->save();
                PendaftaranMutasiStatus::create([
                    'pendaftaran_mutasi_id' => $pendaftaranMutasi->id,
                    'status_mutasi_id' => Status::where('nama', 'Proses')->first()->id,
                    'approved_by' => Auth::user()->id,
                    'message' => 'Pendaftaran mutasi Di Ajukan, Menunggu tindakan',
                ]);
            }
        },3);

        Flash::success('Pendaftaran Mutasi updated successfully.');
        return redirect(route('pendaftaranMutasis.index'));
    }

    /**
     * Remove the specified PendaftaranMutasi from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $pendaftaranMutasi = $this->pendaftaranMutasiRepository->find($id);

        if (empty($pendaftaranMutasi)) {
            Flash::error('Pendaftaran Mutasi not found');
            return redirect(route('pendaftaranMutasis.index'));
        }

        DB::transaction(function () use($id, $pendaftaranMutasi) {
            // hapus media dari pendaftaran mutasi
            $pendaftaranMutasi->getMedia()->each(function ($media) {
                $media->delete();
            });
            $pendaftaranMutasi->clearMediaCollection();

            //hapus media dari pendaftaran mutasi status
            foreach ($pendaftaranMutasi->pendaftaranMutasiStatuses as $pendaftaranMutasiStatus) {
                $pendaftaranMutasiStatus->getMedia()->each(function ($media) {
                    $media->delete();
                });
                $pendaftaranMutasiStatus->clearMediaCollection();
            }

            $pendaftaranMutasi->pendaftaranMutasiStatuses->each->delete();
            
            $this->pendaftaranMutasiRepository->delete($id);
        },3);

        Flash::success('Pendaftaran Mutasi deleted successfully.');
        return redirect(route('pendaftaranMutasis.index'));
    }

    public function contohImport()
    {
        $myFile = public_path("contoh.xlsx");

    	return response()->download($myFile);
    }


    public function export(Request $request) 
    { 
        return Excel::download(new PendaftaranMutasi, 'Mutasi.xlsx');
    }

    public function importView() {
        return view('pendaftaran_mutasis.import');
    }

    public function import(Request $request) 
    {
        $valid = $request->validate([
            'file' => 'required|mimes:csv,xls,xlsx',
        ]);
        
        // return 'sdf';
        Excel::import(new PendaftaranMutasiImport(),request()->file('file'));
        return redirect(route('pendaftaranMutasis.index'));
    }
}
