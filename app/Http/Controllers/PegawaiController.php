<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePegawaiRequest;
use App\Http\Requests\UpdatePegawaiRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\PegawaiRepository;
use Illuminate\Http\Request;
use App\Models\Pegawai;
use App\Models\Pangkat; 
use App\Models\User;
use DB;
use Illuminate\Support\Facades\Hash;
use App\Models\PerangkatDaerah;
use Flash;
use Auth;

class PegawaiController extends AppBaseController
{
    /** @var PegawaiRepository $pegawaiRepository*/
    private $pegawaiRepository;

    public function __construct(PegawaiRepository $pegawaiRepo)
    {
        $this->middleware('permission:pegawais.index', ['only' => ['index','show']]);
        $this->middleware('permission:pegawais.create', ['only' => ['create','store']]);
        $this->middleware('permission:pegawais.edit', ['only' => ['edit','update']]);
        $this->middleware('permission:pegawais.destroy', ['only' => ['destroy']]);
        $this->pegawaiRepository = $pegawaiRepo;
    }

    /**
     * Display a listing of the Pegawai.
     */
    public function index(Request $request)
    {
        if (Auth::user()->hasRole(['admin','super-admin'])) {
            $pegawais = $this->pegawaiRepository->paginate(10);
        }else{
            $pegawais = Auth::user()->pegawai()->paginate(10);
        }

        return view('pegawais.index')->with('pegawais', $pegawais);
    }

    /**
     * Show the form for creating a new Pegawai.
     */
    public function create()
    {   
        $isUpdatePage = false;
        $pangkats = Pangkat::pluck('nama', 'id')->all();
        $users = User::pluck('name', 'id')->all();
        $perangkatDaerahs = PerangkatDaerah::pluck('nama', 'id');
        return view('pegawais.create',compact('isUpdatePage','pangkats','users','perangkatDaerahs'));
    }

    /**
     * Store a newly created Pegawai in storage.
     */
    public function store(CreatePegawaiRequest $request)
    {
        $input = $request->all();
        DB::transaction(function () use ($request, $input) {
            $user = User::create([
                'name' => $input['name'],
                'email' => $input['email'],
                'password' => Hash::make($input['password']),
            ]);

            // Kasih role
            $user->assignRole('pegawai');
            $nip = $input['nip'];

            Pegawai::create([
                'user_id' => $user->id,
                'pangkat_id' => $input['pangkat_id'],
                'perangkat_daerah_id' => $input['perangkat_daerah_id'],
                'nip' => $nip,
                'date_of_birth' => substr($nip, 0, 8),
                'tanggal_masuk' => (int)substr($nip, 8, 6) . '01',
                'jenis_kelamin' => substr($nip, 14, 1) == 1 ? 'pria' : 'wanita',
                'address' => $input['address'],
                'place_of_birth' => $input['place_of_birth'],
            ]);
            Flash::success('Pegawai saved successfully.');
        }, 3);

        return redirect(route('pegawais.index'));
    }

    /**
     * Display the specified Pegawai.
     */
    public function show($id)
    {
        $pegawai = $this->pegawaiRepository->find($id);

        if (empty($pegawai)) {
            Flash::error('Pegawai not found');
            return redirect(route('pegawais.index'));
        }

        return view('pegawais.show')->with('pegawai', $pegawai);
    }

    /**
     * Show the form for editing the specified Pegawai.
     */
    public function edit($id)
    {
        $pegawai = $this->pegawaiRepository->find($id);

        if (empty($pegawai)) {
            Flash::error('Pegawai not found');
            return redirect(route('pegawais.index'));
        }

        $isUpdatePage = true;
        $pangkats = Pangkat::pluck('nama', 'id')->all();
        $users = User::pluck('name', 'id')->all();
        $perangkatDaerahs = PerangkatDaerah::pluck('nama', 'id');

        return view('pegawais.edit',compact('isUpdatePage','pangkats','users','pegawai','perangkatDaerahs'));
    }

    /**
     * Update the specified Pegawai in storage.
     */
    public function update($id, UpdatePegawaiRequest $request)
    {
        $pegawai = $this->pegawaiRepository->find($id);

        if (empty($pegawai)) {
            Flash::error('Pegawai not found');
            return redirect(route('pegawais.index'));
        }

        // user tidak bisa dirubah setelah dibuat
        unset($request['user_id']);
        $input = $request->all();

        DB::transaction(function () use ($request, $input, $id, $pegawai) {

            $pegawai = $this->pegawaiRepository->update($input, $id);

            $user = $pegawai->user->update([
                'name' => $input['name'],
                'email' => $input['email']
            ]);

            $nip = $input['nip'];

            $pegawai->update([
                'pangkat_id' => $input['pangkat_id'],
                'perangkat_daerah_id' => $input['perangkat_daerah_id'],
                'nip' => $nip,
                'date_of_birth' => $input['date_of_birth'],
                'tanggal_masuk' => $input['tanggal_masuk'],
                'jenis_kelamin' => substr($nip, 14, 1) == 1 ? 'pria' : 'wanita',
                'address' => $input['address'],
                'place_of_birth' => $input['place_of_birth'],
            ]);
            Flash::success('Pegawai updated successfully.');
        }, 3);

        return redirect(route('pegawais.index'));
    }

    /**
     * Remove the specified Pegawai from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $pegawai = $this->pegawaiRepository->find($id);

        if (empty($pegawai)) {
            Flash::error('Pegawai not found');
            return redirect(route('pegawais.index'));
        }

        DB::transaction(function () use($id, $pegawai) {
            // hapus media dari pendaftaran mutasi
            $pegawai->pendaftaranMutasis->each->clearMediaCollection();

            foreach ($pegawai->pendaftaranMutasis as $pendaftaranMutasi) {
                $pendaftaranMutasi->getMedia()->each(function ($media) {
                    $media->delete();
                });
            }

            // hapus media dari pendaftaran mutasi status
            foreach ($pegawai->pendaftaranMutasis as $pendaftaranMutasi) {
                foreach ($pendaftaranMutasi->pendaftaranMutasiStatuses as $pendaftaranMutasiStatus) {
                    $pendaftaranMutasiStatus->getMedia()->each(function ($media) {
                        $media->delete();
                    });
                    $pendaftaranMutasiStatus->clearMediaCollection();
                }
            }

            $pegawai->pendaftaranMutasis->each(function ($pendaftaranMutasi) {
                $pendaftaranMutasi->pendaftaranMutasiStatuses->each->delete();
            });

            $pegawai->pendaftaranMutasis->each->delete();
        
            $this->pegawaiRepository->delete($id);
            $pegawai->user->removeRole('pegawai');
            $pegawai->user->syncRoles([]);
            $pegawai->user()->delete();

        },3);

        Flash::success('Pegawai deleted successfully.');
        return redirect(route('pegawais.index'));
    }
}
