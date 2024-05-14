<!-- Pendaftaran Mutasi Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('pendaftaran_mutasi_id', 'Pendaftaran Mutasi:') !!}
    {!! Form::select('pendaftaran_mutasi_id', $pendaftaranMutasis, null ,['class' => 'form-control', 'required']) !!}
</div>

<!-- Approved By Field -->
<div class="form-group col-sm-6">   
    {!! Form::label('approved_by', 'Approved By:') !!}
    {!! Form::select('approved_by', $users, null ,['class' => 'form-control', 'required']) !!}
</div>

<!-- Status Mutasi Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('status_mutasi_id', 'Status Mutasi:') !!}
    {!! Form::select('status_mutasi_id', $status, null ,['class' => 'form-control', 'required']) !!}
</div>

<!-- Message Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('message', 'Message:') !!}
    {!! Form::textarea('message', null, ['class' => 'form-control', 'maxlength' => 65535, 'maxlength' => 65535]) !!}
</div>