<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\User;
use App\Repositories\UserRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Flash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use DB;

class UserController extends AppBaseController
{
    /** @var UserRepository $userRepository*/
    private $userRepository;

    public function __construct(UserRepository $userRepo)
    {
       $this->middleware('permission:users.index', ['only' => ['index','show']]);
       $this->middleware('permission:users.create', ['only' => ['create','store']]);
       $this->middleware('permission:users.edit', ['only' => ['edit','update']]);
       $this->middleware('permission:users.destroy', ['only' => ['destroy']]);
        $this->userRepository = $userRepo;
    }


    public function index(Request $request)
    {
        $users = User::all();

        return view('users.index')->with('users', $users);
    }

    /**
     * Show the form for creating a new User.
     *
     * @return Response
     */
    public function create()
    {
        $sRoles=Role::orderBy('name')->get();
        $roles=[];
        return view('users.create',compact('roles','sRoles'));
    }

    /**
     * Store a newly created User in storage.
     *
     * @param CreateUserRequest $request
     *
     * @return Response
     */
    public function store(CreateUserRequest $request)
    {
        $input = $request->all();
        $roles=[];
        if($request->has('s_role_id')){
            $roles=$input['s_role_id'];
        }

        DB::transaction(function () use($input,$roles) {
            $user = $this->userRepository->create($input);
            $user->syncRoles($roles);
            $user->password = bcrypt($input['password']);
            $user->username = str_replace(" ", "_", $input['username']);
            $user->save();
        },3);

//        Flash::success('User saved successfully.');

        Flash::success('Tambah Akun Berhasil dilakukan');

        return redirect(route('users.index'));
    }

    /**
     * Display the specified User.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $users = $this->userRepository->find($id);

        if (empty($user)) {
            Flash::error('User not found');

            return redirect(route('users.index'));
        }

        return view('users.show')->with('users', $users);
    }

    /**
     * Show the form for editing the specified User.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $user = $this->userRepository->find($id);

        if (empty($user)) {
            Flash::error('User not found');
            return redirect(route('users.index'));
        }
        $sRoles=Role::orderBy('name')->get();
        $roles=$user->roles->pluck('id')->toArray();

        return view('users.edit',compact('roles','sRoles'))->with('user', $user);
    }

    /**
     * Update the specified User in storage.
     *
     * @param int $id
     * @param UpdateUserRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateUserRequest $request)
    {
        $role = Auth::user()->getRoleNames()->first();
        $user = $this->userRepository->find($id);

        if (empty($user)) {
            Flash::error('User not found');
            return redirect(route('users.index'));
        }

        $input=$request->all();

        if($input['password']==='' || $input['password']===null){
            unset($input['password']);
        }

        $roles=[];
        if($request->has('s_role_id')){
            $roles=$input['s_role_id'];
        }

        DB::transaction(function () use($input,$roles,$id,$request){
            $user = $this->userRepository->update($input, $id);
            $user->username = str_replace(" ", "_", $input['username']);
            $user->syncRoles($roles);

            if(isset($input['password'])){
                $user->password = bcrypt($input['password']);
            }
            $user->save();
        },3);


        Flash::success('Updated successfully');

        return redirect(route('users.index'));
    }

    /**
     * Remove the specified User from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $user = $this->userRepository->find($id);

        if($user->hasRole(['admin','super-admin'])){
            Flash::error('Tidak boleh dihapus');
            return redirect(route('users.index'));
        }

        if (empty($user)) {
            Flash::error('User not found');
            return redirect(route('users.index'));
        }
        // return $user->pegawai->pendaftaranMutasis->each->pendaftaranMutasiStatuses;

        DB::transaction(function () use($id, $user) { 
            $user->syncRoles([]);

            // hapus media dari pendaftaran mutasi
            $user->pegawai->pendaftaranMutasis->each->clearMediaCollection();
            foreach ($user->pegawai->pendaftaranMutasis as $pendaftaranMutasi) {
                $pendaftaranMutasi->getMedia()->each(function ($media) {
                    $media->delete();
                });
            }

            // hapus media dari pendaftaran mutasi status
            foreach ($user->pegawai->pendaftaranMutasis as $pendaftaranMutasi) {
                foreach ($pendaftaranMutasi->pendaftaranMutasiStatuses as $pendaftaranMutasiStatus) {
                    $pendaftaranMutasiStatus->clearMediaCollection();
                    $pendaftaranMutasiStatus->getMedia()->each(function ($media) {
                        $media->delete();
                    });
                }
            }

            // hapus pendaftaran mutasi status, pendaftaran mutasi
            foreach ($user->pegawai->pendaftaranMutasis as $pendaftaranMutasi) {
                foreach ($pendaftaranMutasi->pendaftaranMutasiStatuses as $status) {
                    $status->delete();
                }
                $pendaftaranMutasi->delete();
            }

            $user->pegawai->pendaftaranMutasis->each->delete();
            // hapus semua media
            $user->pegawai->delete();
    
            $this->userRepository->delete($id);

            Flash::success('Deleted successfully');
        },3);

        return redirect(route('users.index'));
    }
    public function profil() {
        $user = User::where('id',Auth::user()['id'])->first();
        $pangkats = \App\Models\Pangkat::pluck('nama','id');
        $pangkatsGolongans = \App\Models\PangkatGolongan::pluck('name','id');
        $perangkatDaerahs = \App\Models\PerangkatDaerah::pluck('nama','id');
        return view('users/profil/profil',compact('user','pangkats','perangkatDaerahs','pangkatsGolongans'));
    }

    public function editProfiles($id) {
        $user = $this->userRepository->find($id);
        $pangkats = \App\Models\Pangkat::pluck('nama','id');
        return view('users.profil.edit',compact('user','pangkats'));
    }

    public function updateProfile($id, UpdateUserRequest $request) {
        $user = $this->userRepository->find($id);
        
        $input=$request->except('foto');
        
        $passBeUpdate = true;
        
        // jika salah satu kosong maka password tidak akan di update
        if($input['current_password'] ==='' || $input['current_password']===null ||
            $input['password'] ==='' || $input['password']===null ||
            $input['password_confirmation'] ==='' || $input['password_confirmation']===null
        ){
            $passBeUpdate = false;
        }
        
        if ($passBeUpdate) {
            // jika password dan password confirmation tidak sama maka password tidak akan di update
            if ($input['password'] != $input['password_confirmation']) {
                Flash::error('Password dan Password Confirmation tidak sama');
                $passBeUpdate = false;
            }
        }

        if ($passBeUpdate) {
            // jika current password tidak sama dengan password yang ada di database maka password tidak akan di update
            if (!(Hash::check($input['current_password'], Auth::user()->password))) {
                $passBeUpdate = false;
                Flash::error('Password Anda Salah');
            }
        }
        
        if ($passBeUpdate == false) {
            unset($input['password']);
        }else{
            Flash::success('Ganti Password Berhasil');
            $input['password'] = bcrypt($input['password']);
        }

        // return $input;

        $input['passBeUpdate'] = $passBeUpdate;

        DB::transaction(function () use($input,$id,$request,$passBeUpdate){
            $date = $date = Carbon::now()->format('dmY_His');
            $user = $this->userRepository->update($input, $id);
            $pegawai = $user->pegawai;
            $pegawai->update($input);
            $pegawai->save();

            if ($request->hasFile('foto')) {
                $file = $request->file('foto');
                $user->clearMediaCollection('foto');
                $user->addMedia($file)->toMediaCollection('foto');
            }
            
            $user->save();
        },2);

        return redirect(url('profil'));
    }
}
