<!-- Title Field -->
<div class="form-group col-sm-12">
    {!! Form::label('title', 'Title:') !!}
    {!! Form::text('title', null, ['class' => 'form-control', 'required']) !!}
</div>

<div class="form-group col-md-12">
    {!! Form::label('media', 'Foto Kegiatan:') !!}
    <div class="position-relative">
        @if(!isset($kegiatan))
            <x-media-library-attachment  multiple name="media" rules="mimes:png,jpeg,pdf"/>
        @else
            <x-media-library-collection :model="$kegiatan" multiple name="media" rules="mimes:png,jpeg,pdf"/>
        @endif
    </div>
</div>

{{--<!-- Users Created Id Field -->--}}
{{--<div class="form-group col-sm-6">--}}
{{--    {!! Form::label('users_created_id', 'Users Created Id:') !!}--}}
    {!! Form::hidden('users_created_id', auth()->id(), ['class' => 'form-control', 'required']) !!}
{{--</div>--}}

{{--<!-- Users Updated Id Field -->--}}
{{--<div class="form-group col-sm-6">--}}
{{--    {!! Form::label('users_updated_id', 'Users Updated Id:') !!}--}}
    {!! Form::hidden('users_updated_id', auth()->id(), ['class' => 'form-control', 'required']) !!}
{{--</div>--}}

<!-- Schedule Date Field -->
<div class="form-group col-lg-4">
    {!! Form::label('schedule_date', 'Tanggal Agenda',['class'=>'text-bold-600 black']) !!}
    {!! Form::date('schedule_date',$kegiatan->schedule_date ?? date('d-m-Y'), ['class' => 'custom-select','value' => '$agenda->schedule_date']) !!}
</div>

<div class="form-group col-lg-4">
    {!! Form::label('schedule_time', 'Waktu Kegiatan',['class'=>'text-bold-600 black']) !!}
    {!! Form::time('schedule_time', $kegiatan->schedule_time ?? date('h:i a'), ['class' => 'custom-select','value' => '$agenda->schedule_time']) !!}
</div>

<!-- Schedule Time Field -->
<div class="form-group col-lg-4">
    {!! Form::label('tipe_acara', 'Tipe Acara',['class'=>'text-bold-600 black']) !!}
    {!! Form::select('tipe_acara',['offline'=>'Offline','online'=>'Online','hybrid'=>'Hybrid'],null, ['class' => 'custom-select','value' => '$agenda->schedule_time']) !!}
</div>

<!-- Location Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('location', 'Tempat Kegiatan:') !!}
    {!! Form::textarea('location', null, ['class' => 'form-control', 'rows'=>2]) !!}
</div>

<!-- Content Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('content', 'Content:') !!}
    {!! Form::textarea('content', null, ['class' => 'form-control', 'required']) !!}
</div>

@section('scripts')

    <script type="text/javascript" src="{{ asset('ckeditor/ckeditor.js') }}"></script>
    <script type="text/javascript" src="{{ asset('ckeditor/adapters/jquery.js') }}"></script>
    <script  type="text/javascript">
        setTimeout(function(){
            CKEDITOR.config.enterMode = CKEDITOR.ENTER_BR;
            CKEDITOR.replace( 'content');
            // CKEDITOR.replace( 'location');
        },300);
    </script>

@endsection
