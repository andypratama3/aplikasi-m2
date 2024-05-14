<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use DB;
use App\Models\Pegawai;
use App\Models\PerangkatDaerah;
use App\Models\Pangkat;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/pendaftaranMutasis';


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showRegistrationForm()
    {
        $perangkatDaerahs = PerangkatDaerah::pluck('nama','id');
        $pangkats = Pangkat::pluck('nama','id');
        return view("auth.register", compact('perangkatDaerahs','pangkats'));
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'nip' => ['required', 'string', 'min:18','max:19','unique:pegawai'],
            'password' => ['required', 'string', 'min:8','max:255']
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $user = null;

        DB::transaction(function () use ($data, &$user) {
            $user = User::create([
                'name' => ucwords($data['name']),
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
            ]);

            // Kasih role
            $user->assignRole('pegawai');

            $nip = $data['nip'];

            Pegawai::create([
                'user_id' => $user->id,
                'nip' => $nip,
                'date_of_birth' => substr($nip, 0, 8),
                'tanggal_masuk' => (int)substr($nip, 8, 6) . '01',
                'jenis_kelamin' => substr($nip, 14, 1) == 1 ? 'pria' : 'wanita'
            ]);

        }, 3);

        return $user;
    }

}