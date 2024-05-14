<div class="modal fade text-left" id="editProfil" tabindex="-1" role="dialog" aria-labelledby="editProfil"
    aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content rounded-1">
            <div class="modal-header">
                <label class="modal-title font-medium-1 text-bold-700 black pl-1 text-uppercase" id="myModalLabel33"><i
                        class="ft-sliders green mr-0-1 font-medium-2"></i> Perubahan Data Akun</label>
                <button type="button" class="close danger" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="ft-x red"></i></span>
                </button>
            </div>
            <div class="card-body">
                {!! Form::model($user, [
                    'url' => 'updateProfile/' . $user->id,
                    'method' => 'patch',
                    'class' => 'form form-horizontal',
                    'files' => true,
                ]) !!}
                <div class="form-body">
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="card mb-0">
                                <div class="card-body pb-0">
                                    <div class="text-center mb-1">
                                        <div v-if="foto.length > 0">
                                            {{-- <img id="logo_review" :src="foto" alt="your image"
                                                class="height-200 rounded img-fluid" /> --}}
                                        </div>
                                        <div v-else>
                                            @if (!empty(Auth::user()->getFirstMedia('foto')))
                                                <div>
                                                    <img id="logo_review" src="{{ Auth::user()->getFirstMedia('foto')->getUrl() }}"
                                                        alt="your image" class="height-200 img-fluid rounded" />
                                                </div>
                                            @else
                                                <img src="{{ asset('master/app-assets/images/gallery/user_profil.png') }}"
                                                    alt="your image" class="height-200 img-fluid rounded" />
                                            @endif
                                        </div>
                                        <div class="mt-1">
                                            <input id="foto" type="file" name="foto" accept="image/*"
                                                @change="previewFoto" class="btn btn-light rounded-2">
                                        </div>

                                        {{-- @if(empty(Auth::user()->getFirstMedia('foto')))
                                        <img src="{{ asset('master/app-assets/images/gallery/user_profil.png') }}" class="img-fluid rounded height-200">
                                    @else
                                        <img src="{{ Auth::user()->getFirstMedia('foto')->getUrl()  }}" alt="avatar" class="rounded-circle bg-grey bg-lighten-4 p-0-1 height-200 width-200 box-shadow-0-1" style="object-fit: cover;object-position: top;">
                                    @endif --}}


                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-9">
                            <div class="card mb-0">
                                <div class="card-body">
                                    <div class="text-bold-700 black font-medium-3 text-uppercase"><i
                                            class="fa fa-pencil-square green"></i> Profil Akun</div>
                                    <div class="row mt-1">
                                        <div class="col-lg-6">
                                            <!-- Name Field -->
                                            <div class="form-group">
                                                {!! Form::label('name', 'Nama Lengkap', ['class' => 'dark']) !!}
                                                {!! Form::text('name', null, ['class' => 'form-control rounded-2 text-bold-600 black']) !!}
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <!-- Email Field -->
                                            <div class="form-group">
                                                {!! Form::label('email', 'Email Aktif', ['class' => 'dark']) !!}
                                                {!! Form::email('email', null, ['class' => 'form-control rounded-2 text-bold-600 black']) !!}
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                {!! Form::label('nip', 'NIP:', ['class' => 'dark']) !!}
                                                {!! Form::text('nip', $user->pegawai->nip, [
                                                    'class' => 'form-control rounded-2 text-bold-600 black',
                                                ]) !!}
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                {!! Form::label('date_of_birth', 'Tanggal Lahir:', ['class' => 'dark']) !!}
                                                {!! Form::date('date_of_birth', $user->pegawai->date_of_birth ?? date('Y-m-d'), [
                                                    'class' => 'form-control rounded-2 text-bold-600 black',
                                                ]) !!}
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                {!! Form::label('place_of_birth', 'Tempat Lahir:', ['class' => 'dark']) !!}
                                                {!! Form::text('place_of_birth', $user->pegawai->place_of_birth, [
                                                    'class' => 'form-control rounded-2 text-bold-600 black',
                                                ]) !!}
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                {!! Form::label('jenis_kelamin', 'Jenis Kelamin') !!}
                                                {!! Form::select('jenis_kelamin', ['pria' => 'Pria', 'wanita' => 'Wanita'], $user->pegawai->jenis_kelamin, [
                                                    'class' => 'form-control',
                                                    'id' => 'jenis_kelamin-select',
                                                ]) !!}
                                            </div>

                                            <script>
                                                document.addEventListener("DOMContentLoaded", function() {
                                                    var jenisKelaminSelect = document.getElementById('jenis_kelamin-select');
                                                    jenisKelaminSelect.value = '{{ $user->pegawai->jenis_kelamin }}';
                                                });
                                            </script>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                {!! Form::label('address', 'Alamat:', ['class' => 'dark']) !!}
                                                {!! Form::text('address', $user->pegawai->address, [
                                                    'class' => 'form-control rounded-2 text-bold-600 black',
                                                ]) !!}
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                {!! Form::label('pangkat_id', 'Pangkat:', ['class' => 'dark']) !!}
                                                {!! Form::select('pangkat_id', $pangkats, $user->pegawai->pangkat->id ?? null, [
                                                    'placeholder' => 'Pilih Pangkat',
                                                    'class' => 'form-control rounded-2 text-bold-600 black',
                                                ]) !!}
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                {!! Form::label('pangkat_golongan_id', 'Pangkat Golongan:', ['class' => 'dark']) !!}
                                                {!! Form::select('pangkat_golongan_id', $pangkatsGolongans, $user->pegawai->pangkatGolongan->id ?? null, [
                                                    'placeholder' => 'Pilih Pangkat Golongan',
                                                    'class' => 'form-control rounded-2 text-bold-600 black',
                                                ]) !!}
                                            </div>
                                        </div>
                                        
                                        

                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                {!! Form::label('perangkat_daerah_id', 'Perangkat Daerah:', ['class' => 'dark']) !!}
                                                {!! Form::select('perangkat_daerah_id', $perangkatDaerahs, $user->pegawai->perangkatDaerah->id ?? null, [
                                                    'class' => 'form-control rounded-2 text-bold-600 black',
                                                ]) !!}
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="card">
                                            <div
                                                class="font-medium-3 text-bold-800 black mb-2 border-top-grey border-top-lighten-2 pt-2">
                                                <i class="ft-sliders green"></i> Pengaturan Kata Sandi
                                            </div>

                                            <div
                                                class="card-body rounded-2 border border-green border-left-6 border-left-green box-shadow-1 p-1">
                                                <div id="heading1" class="cursor-pointer" role="tab"
                                                    data-toggle="collapse" data-parent="#accordionWrapa1"
                                                    href="#steap1">
                                                    <a data-toggle="collapse" data-parent="#accordionWrapa1"
                                                        href="#steap1" aria-expanded="false" aria-controls="accordion1"
                                                        class="font-medium-1 text-bold-800 green text-uppercase">
                                                        <i class="fa fa-lock green mr-0-1 font-medium-2"></i> Pengaturan
                                                        Kata Sandi
                                                    </a>
                                                </div>
                                                <div id="steap1" role="tabpanel" aria-labelledby="heading1"
                                                    class="collapse">
                                                    <div class="card-content">
                                                        <div class="card-body rounded-0-5">
                                                            <div class="row">
                                                                <div class="form-group col-12">
                                                                    {!! Form::label('current_password', 'Password Lama', ['class' => 'dark']) !!}
                                                                    <div class="position-relative has-icon-right">
                                                                        {!! Form::password('current_password', [
                                                                            'class' => 'form-control text-bold-600 black font-medium-2 rounded-2',
                                                                            'autocomplete' => 'off',
                                                                        ]) !!}
                                                                        <div class="form-control-position">
                                                                            <i class="fa fa-eye font-medium-3 toggle-password"
                                                                                toggle="#current_password"></i>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group col-lg-6">
                                                                    {!! Form::label('password', 'Password Baru', ['class' => 'dark']) !!}
                                                                    <div class="position-relative has-icon-right">
                                                                        {!! Form::password('password', [
                                                                            'class' => 'form-control text-bold-600 black font-medium-2 rounded-2',
                                                                            'autocomplete' => 'off',
                                                                        ]) !!}
                                                                        <div class="form-control-position">
                                                                            <i class="fa fa-eye font-medium-3 toggle-password"
                                                                                toggle="#password"></i>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group col-lg-6">
                                                                    {!! Form::label('password_confirmation', 'Konfirmasi Password Baru', ['class' => 'dark']) !!}
                                                                    <div class="position-relative has-icon-right">
                                                                        {!! Form::password('password_confirmation', [
                                                                            'class' => 'form-control text-bold-600 black font-medium-2 rounded-2',
                                                                            'autocomplete' => 'off',
                                                                        ]) !!}
                                                                        <div class="form-control-position">
                                                                            <i class="fa fa-eye font-medium-3 toggle-password"
                                                                                toggle="#password_confirmation"></i>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-right">
                    {!! Form::submit('Simpan Perubahan', ['class' => 'btn btn-green rounded-2 btn-glow mr-1']) !!}
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
