<!-- Link Field -->
<div class="form-group col-sm-6">
    {!! Form::label('link', 'Link:') !!}
    {!! Form::text('link', null, ['class' => 'form-control', 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>

<!-- Dari Tanggal Field -->
<div class="form-group col-sm-6">
    {!! Form::label('dari_tanggal', 'Dari Tanggal:') !!}
    {!! Form::date('dari_tanggal', $linkSk->dari_tanggal ?? date('Y-m-d'), ['class' => 'form-control','id'=>'dari_tanggal']) !!}
</div>

@push('page_scripts')
    <script type="text/javascript">
        $('#dari_tanggal').datepicker()
    </script>
@endpush

<!-- Sampai Tanggal Field -->
<div class="form-group col-sm-6">
    {!! Form::label('sampai_tanggal', 'Sampai Tanggal:') !!}
    {!! Form::date('sampai_tanggal', $linkSk->sampai_tanggal ?? date('Y-m-d'), ['class' => 'form-control','id'=>'sampai_tanggal']) !!}
</div>

@push('page_scripts')
    <script type="text/javascript">
        $('#sampai_tanggal').datepicker()
    </script>
@endpush