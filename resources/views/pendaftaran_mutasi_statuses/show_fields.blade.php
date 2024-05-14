<!-- Pendaftaran Mutasi Id Field -->
<div class="col-sm-12">
    {!! Form::label('pendaftaran_mutasi_id', 'Pendaftaran Mutasi Id:') !!}
    <p>{{ $pendaftaranMutasiStatus->pendaftaran_mutasi_id }}</p>
</div>

<!-- Approved By Field -->
<div class="col-sm-12">
    {!! Form::label('approved_by', 'Approved By:') !!}
    <p>{{ $pendaftaranMutasiStatus->approved_by }}</p>
</div>

<!-- Status Mutasi Id Field -->
<div class="col-sm-12">
    {!! Form::label('status_mutasi_id', 'Status Mutasi Id:') !!}
    <p>{{ $pendaftaranMutasiStatus->status_mutasi_id }}</p>
</div>

<!-- Message Field -->
<div class="col-sm-12">
    {!! Form::label('message', 'Message:') !!}
    <p>{{ $pendaftaranMutasiStatus->message }}</p>
</div>

