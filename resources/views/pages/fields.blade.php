

<!-- Judul Field -->
<div class="form-group col-sm-6">
    {!! Form::label('judul', 'Judul',['class'=>'text-bold-700 black']) !!}
    {!! Form::text('judul', null, ['class' => 'form-control', 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>

<!-- Judul English Field -->
<div class="form-group col-sm-6">
    {!! Form::label('judul_english', 'Judul English',['class'=>'text-bold-700 black']) !!}
    {!! Form::text('judul_english', null, ['class' => 'form-control', 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>

<div class="form-group col-12">
    {!! Form::label('foto', 'Foto Multiple Upload',['class'=>'text-bold-700 black']) !!}
    <div class="position-relative">
        @if(!isset($page))
            <x-media-library-attachment  multiple name="media" rules="mimes:png,jpg,jpeg"/>
        @else
            <x-media-library-collection :model="$page"  name="media" rules="mimes:png,jpg,jpeg"/>
        @endif
    </div>
</div>

<!-- Page Category Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('parent_page_id', 'Parent',['class'=>'text-bold-700 black']) !!}
    {!! Form::select('parent_page_id', $parent,null, ['placeholder' =>"",'class' => 'form-control']) !!}
</div>

<!-- Page Category Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('page_category_id', 'Page Category',['class'=>'text-bold-700 black']) !!}
    {!! Form::select('page_category_id', $pageCategory,null, ['placeholder' =>"",'class' => 'form-control', 'required']) !!}
</div>


<!-- Isi Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('isi', 'Deskripsi Page',['class'=>'text-bold-700 black']) !!}
    {!! Form::textarea('isi', null, ['class' => 'form-control', 'maxlength' => 65535, 'maxlength' => 65535]) !!}
</div>


<!-- Custom Url Field -->
<div class="form-group col-sm-6">
    {!! Form::label('custom_url', 'Custom URL',['class'=>'text-bold-700 black']) !!}
    {!! Form::text('custom_url', null, ['class' => 'form-control', 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>

<!-- External Url Field -->
<div class="form-group col-sm-6">
    {!! Form::label('external_url', 'External URL',['class'=>'text-bold-700 black']) !!}
    {!! Form::text('external_url', null, ['class' => 'form-control', 'maxlength' => 255, 'maxlength' => 255,'placeholder'=>'sertakan "https://"']) !!}
</div>

{!! Form::hidden('users_id', auth()->id()) !!}



@section('scripts')

    <script type="text/javascript" src="{{ asset('ckeditor/ckeditor.js') }}"></script>
    <script type="text/javascript" src="{{ asset('ckeditor/adapters/jquery.js') }}"></script>
    <script  type="text/javascript">
        setTimeout(function(){
            CKEDITOR.config.enterMode = CKEDITOR.ENTER_BR;
            CKEDITOR.replace( 'isi');

        },300);
    </script>


@endsection
