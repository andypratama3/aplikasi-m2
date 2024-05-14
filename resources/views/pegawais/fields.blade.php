<!-- name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Nama:') !!}
    {!! Form::text('name', $isUpdatePage ? $pegawai->user->name : null, [
        'class' => 'form-control',
        'required',
        'maxlength' => 45,
    ]) !!}
</div>

<!-- Email Field -->
<div class="form-group col-sm-6">
    {!! Form::label('email', 'Email:') !!}
    {!! Form::email('email', $isUpdatePage ? $pegawai->user->email : null, [
        'class' => 'form-control',
        'required',
        'maxlength' => 45,
    ]) !!}
</div>

<!-- Nip Field -->
<div class="form-group col-sm-6">
    {!! Form::label('nip', 'NIP:') !!}
    {!! Form::text('nip', null, ['class' => 'form-control', 'required', 'maxlength' => 45, 'minlength' => 18]) !!}
</div>

@if ($isUpdatePage)
    <div class="form-group col-sm-6">
        {!! Form::label('tanggal_masuk', 'Tanggal Masuk:') !!}
        {!! Form::date('tanggal_masuk', $pegawai->tanggal_masuk ?? date('Y-m-d'), ['class' => 'form-control']) !!}
    </div>

    @push('page_scripts')
        <script type="text/javascript">
            $('#tanggal_masuk').datepicker()
        </script>
    @endpush

    <div class="form-group col-sm-6">
        {!! Form::label('date_of_birth', 'Date Of Birth:') !!}
        {!! Form::date('date_of_birth', $pegawai->date_of_birth ?? date('Y-m-d'), ['class' => 'form-control']) !!}
    </div>

    @push('page_scripts')
        <script type="text/javascript">
            $('#date_of_birth').datepicker()
        </script>
    @endpush

    <div class="form-group col-sm-6">
        {!! Form::label('jenis_kelamin', 'Jenis Kelamin') !!}
        {!! Form::select('jenis_kelamin', ['pria' => 'Pria', 'wanita' => 'Wanita'], $pegawai->jenis_kelamin ?? null, [
            'class' => 'form-control',
            'id' => 'jenis_kelamin-select',
        ]) !!}
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var jenisKelaminSelect = document.getElementById('jenis_kelamin-select');
            jenisKelaminSelect.value = '{{ $pegawai->jenis_kelamin }}';
        });
    </script>

    <input type="hidden" name="user_id" value="-">
@else
    <input type="hidden" name="user_id" value="-">
    <input type="hidden" name="tanggal_masuk" value="-">
    <input type="hidden" name="date_of_birth" value="-">

    <div class="form-group col-sm-6">
        {!! Form::label('password', 'Password:') !!}
        {!! Form::password('password', ['class' => 'form-control']) !!}
    </div>
@endif

<!-- Place Of Birth Field -->
<div class="form-group col-sm-6">
    {!! Form::label('place_of_birth', 'Place Of Birth:') !!}
    {!! Form::text('place_of_birth', null, ['class' => 'form-control', 'maxlength' => 255]) !!}
</div>

<!-- Address Field -->
<div class="form-group col-sm-6">
    {!! Form::label('address', 'Address:') !!}
    {!! Form::text('address', null, ['class' => 'form-control', 'maxlength' => 255]) !!}
</div>

<!-- Pangkat Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('pangkat_id', 'Pangkat:') !!}
    {!! Form::select('pangkat_id', $pangkats, null, ['class' => 'form-control', 'required']) !!}
</div>

<div class="col-lg-6">
    <div class="form-group">
        {!! Form::label('perangkat_daerah_id', 'Perangkat Daerah:', ['class' => 'dark']) !!}
        {!! Form::select('perangkat_daerah_id', $perangkatDaerahs, null, [
            'class' => 'form-control rounded-2 text-bold-600 black',
        ]) !!}
    </div>
</div>
