@extends('layouts.app')
@section('content')
<div id="user">
    @include('flash::message')
    <div class="content-body">
        <div class="row">
            <div class="col-lg-12">
                <div class="card box-shadow-1 rounded-1">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-5">
                                <div class="card-body text-center">
                                    @if(empty(Auth::user()->getFirstMedia('foto')))
                                        <img src="{{ asset('master/app-assets/images/gallery/user_profil.png') }}" class="img-fluid rounded height-200">
                                    @else
                                        <img src="{{ Auth::user()->getFirstMedia('foto')->getUrl()  }}" alt="avatar" class="rounded-circle bg-grey bg-lighten-4 p-0-1 height-200 width-200 box-shadow-0-1" style="object-fit: cover;object-position: top;">
                                    @endif

                                    <div class="font-medium-1 text-bold-700 black mt-2">{{ Auth::user()['name'] }}</div>
                                    <div class="font-small-3 black">{{ Auth::user()->email }}</div>
                                    <a data-target="#editProfil" data-toggle="modal" href="javascript:void(0)"  class="btn btn-green btn-sm mt-2 round btn-glow">Ubah Profil</a>
                                    @include('users.modal.edit_profile')
                                    <p class="mb-0 mt-2"><i class="fa fa-refresh"></i> <i>Last Update {{ Carbon\Carbon::parse(Auth::user()['updated_at'])->format('d F Y - H:i:s') }}</i></p>
                                </div>
                            </div>
                            <div class="col-lg-7">
                                <div class="card-body p-0">
                                    <table class="table black mb-0 font-small-4 table-responsive">
                                        <tr>
                                            <td colspan="3" class="p-1 border-top-0">
                                                <div class="font-medium-2 text-bold-800 black">Data Akun <i class="fa fa-check-circle green"></i></div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="p-1">Nama</td>
                                            <td class="p-1">:</td>
                                            <td class="p-1">{{ $user->name}}</td>
                                        </tr>
                                        <tr>
                                            <td class="p-1">Email</td>
                                            <td class="p-1">:</td>
                                            <td class="p-1">{{ $user->email}}</td>
                                        </tr>
                                        <tr>
                                            <td class="p-1">NIP</td>
                                            <td class="p-1">:</td>
                                            <td class="p-1">{{ $user?->pegawai?->nip  }}</td>
                                        </tr>
                                        <tr>
                                            <td class="p-1">Tanggal Lahir</td>
                                            <td class="p-1">:</td>
                                            <td class="p-1">{{ $user?->pegawai?->date_of_birth?->format('d F Y') }}</td>
                                        </tr>
                                        <tr>
                                            <td class="p-1">Tempat Lahir</td>
                                            <td class="p-1">:</td>
                                            <td class="p-1">{{ $user?->pegawai?->place_of_birth}}</td>
                                        </tr>
                                        <tr>
                                            <td class="p-1">Jenis Kelamin</td>
                                            <td class="p-1">:</td>
                                            <td class="p-1">{{ $user?->pegawai?->jenis_kelamin}}</td>
                                        </tr>
                                        <tr>
                                            <td class="p-1">Pangkat</td>
                                            <td class="p-1">:</td>
                                            <td class="p-1">{{ $user->pegawai->pangkat->nama ?? 'N/A'}}</td>
                                        </tr>
                                        <tr>
                                            <td class="p-1">Pangkat Golongan</td>
                                            <td class="p-1">:</td>
                                            <td class="p-1">{{ $user->pegawai->pangkatGolongan->name ?? 'N/A'}}</td>
                                        </tr>
                                        <tr>
                                            <td class="p-1">Alamat</td>
                                            <td class="p-1">:</td>
                                            <td class="p-1">{{ $user?->pegawai?->address}}</td>
                                        </tr>
                                        <tr>
                                            <td class="p-1">Perangkat Daerah / Instansi</td>
                                            <td class="p-1">:</td>
                                            <td class="p-1">{{ $user?->pegawai?->perangkatDaerah->nama ?? ''}}</td>
                                        </tr>
                                        <tr>
                                            <td class="p-1">Bergabung PNS</td>
                                            <td class="p-1">:</td>
                                            <td class="p-1">{{ Carbon\Carbon::parse(Auth::user()['created_at'])->format('d F Y') }}</td>
                                        </tr>
                                        <tr>
                                            <td class="p-1">Role</td>
                                            <td class="p-1">:</td>
                                            <td class="p-1">
                                                @foreach(Auth::user()->roles as $item)
                                                    <span class="red text-bold-700">{!! $item->name !!} ({!! $item->desc !!}) </span>
                                                @endforeach
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
    <script src="{{ asset('js/user.js') }}"></script>
    <script src="{{asset('master/app-assets/js/scripts/forms/form-login-register.js')}}" type="text/javascript"></script>

@endsection

