<!-- Title Field -->
<div class="row">
    <div class="form-group col-lg-12">
        {!! Form::label('title', 'Judul Agenda',['class'=>'text-bold-600 black']) !!}
        <div class="position-relative">
            {!! Form::text('title', null, ['class' => 'form-control']) !!}
        </div>
    </div>

    <div class="form-group col-lg-12">
        {!! Form::label('pelaksana', 'Pelaksana',['class'=>'text-bold-600 black']) !!}
        <div class="position-relative">
            {!! Form::text('pelaksana', null, ['class' => 'form-control']) !!}
        </div>
    </div>

    <!-- Agenda Category Id Field -->
    <div class="form-group col-lg-4">
        {!! Form::label('agenda_category_id', 'Kategori Agenda',['class'=>'text-bold-600 black']) !!}
        <div class="position-relative">
            {!! Form::select('agenda_category_id', $agendaCategories,null, ['class' => 'custom-select','placeholder' => '-- Pilih kategori agenda']) !!}
        </div>
    </div>

    <!-- Schedule Date Field -->
    <div class="form-group col-lg-3">
        {!! Form::label('schedule_date', 'Tanggal Agenda',['class'=>'text-bold-600 black']) !!}
        {!! Form::date('schedule_date',$agenda->schedule_date ?? date('d-m-Y'), ['class' => 'custom-select','value' => '$agenda->schedule_date']) !!}
    </div>

    <!-- Schedule Time Field -->
    <div class="form-group col-lg-3">
        {!! Form::label('schedule_time', 'Waktu Agenda',['class'=>'text-bold-600 black']) !!}
        {!! Form::time('schedule_time', $agenda->schedule_time ?? date('h:i a'), ['class' => 'custom-select','value' => '$agenda->schedule_time']) !!}
    </div>

    <!-- Schedule Time Field -->
    <div class="form-group col-lg-2">
        {!! Form::label('tipe_acara', 'Tipe Acara',['class'=>'text-bold-600 black']) !!}
        {!! Form::select('tipe_acara',['offline'=>'Offline','online'=>'Online','hybrid'=>'Hybrid'],null, ['class' => 'custom-select','value' => '$agenda->schedule_time']) !!}
    </div>

    <!-- Agenda Category Id Field -->
    <div class="form-group col-lg-12">
        {!! Form::label('location', 'Tempat Agenda',['class'=>'text-bold-600 black']) !!}
        <div class="position-relative">
            {!! Form::textarea('location',null, ['class' => 'form-control','rows'=>2]) !!}
        </div>
    </div>

    <!-- Content Field -->
    <div class="form-group col-12">
        {!! Form::label('partisipasi', 'Agenda Dihadiri',['class'=>'text-bold-600 black']) !!}
        <div class="position-relative">
            {!! Form::textarea('partisipasi', null, ['class' => 'form-control']) !!}
        </div>
    </div>
</div>

<!-- Content Field -->
<div class="form-group">
    {!! Form::label('content', 'Deskripsi Agenda',['class'=>'text-bold-600 black']) !!}
    <div class="position-relative">
        {!! Form::textarea('content', null, ['class' => 'form-control','required']) !!}
    </div>
</div>


<!-- Sudah di modifikasi -->
<!-- Submit Field -->
<div class="form-actions center">
    <a href="{!! route('agendas.index') !!}" class="btn btn-danger"> <i class="fa fa-close"></i> Batal</a>
    {!! Form::submit('Simpan', ['class' => 'btn btn-green mr-1']) !!}
</div>

@section('scripts')

    <script type="text/javascript" src="{{ asset('ckeditor/ckeditor.js') }}"></script>
    <script type="text/javascript" src="{{ asset('ckeditor/adapters/jquery.js') }}"></script>
    <script  type="text/javascript">
        setTimeout(function(){
            CKEDITOR.config.enterMode = CKEDITOR.ENTER_BR;
            CKEDITOR.replace( 'content');
            CKEDITOR.replace( 'partisipasi');
        },300);
    </script>

@endsection

