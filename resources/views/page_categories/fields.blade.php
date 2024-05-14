<div class="form-group col-12">
    {!! Form::label('icon', 'Icon',['class'=>'text-bold-700 black']) !!}
    <div class="position-relative">
        @if(!isset($page))
            <x-media-library-attachment  multiple name="media" rules="mimes:png,jpg,jpeg"/>
        @else
            <x-media-library-collection :model="$page"  name="media" rules="mimes:png,jpg,jpeg"/>
        @endif
    </div>
</div>

<!-- Nama Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Nama',['class'=>'text-bold-700 black']) !!}
    {!! Form::text('name', null, ['class' => 'form-control', 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>
<!-- Parent Page Category Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('parent_page_category_id', 'Parent Page Category',['class'=>'text-bold-700 black']) !!}
    {!! Form::select('parent_page_category_id', $parent,null, ['placeholder' =>"",'class' => 'form-control']) !!}
</div>

<!-- Keterangan Field -->
<div class="form-group col-sm-12">
    {!! Form::label('keterangan', 'Keterangan ',['class'=>'text-bold-700 black']) !!}
    {!! Form::textarea('keterangan', null, ['class' => 'form-control']) !!}
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

@section('scripts')

    <script type="text/javascript" src="{{ asset('ckeditor/ckeditor.js') }}"></script>
    <script type="text/javascript" src="{{ asset('ckeditor/adapters/jquery.js') }}"></script>
    <script  type="text/javascript">
        setTimeout(function(){
            CKEDITOR.config.enterMode = CKEDITOR.ENTER_BR;
            CKEDITOR.replace( 'keterangan');

        },300);
    </script>


@endsection
