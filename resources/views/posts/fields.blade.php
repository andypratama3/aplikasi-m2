<!-- Title Field -->
<div class="form-group col-sm-12">
    {!! Form::label('foto', 'Foto :') !!}
    <div class="position-relative">
        @if(!isset($post))
            <x-media-library-attachment  multiple name="media" rules="mimes:png,jpeg"/>
        @else
            <x-media-library-collection :model="$post"  name="media" rules="mimes:png,jpeg"/>
        @endif
    </div>
</div>
<div class="form-group col-sm-6">
    {!! Form::label('title', 'Judul :') !!}
    <div class="position-relative">
        {!! Form::text('title', null, ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group col-sm-6">
    {!! Form::label('image_caption', 'Judul Foto :') !!}
    <div class="position-relative">
        {!! Form::text('image_caption', null, ['class' => 'form-control']) !!}
    </div>
</div>
<!-- Post Category Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('post_category_id', 'Kategori Post :') !!}
    <div class="position-relative">
        {!! Form::select('post_category_id',$postCategories, null, ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group col-sm-6">
    {!! Form::label('created_at', 'Tanggal :') !!}
    <div class="position-relative">
        {!! Form::Date('created_at', isset($post)?$post->created_at->format('Y-m-d'):\Carbon\Carbon::today(), ['class' => 'form-control']) !!}
    </div>
</div>


<!-- Content Field -->
<div class="form-group col-sm-12">
    {!! Form::label('content', 'Content:') !!}
    <div class="position-relative">
        {!! Form::textarea('content', null, ['class' => 'form-control']) !!}
    </div>
</div>


<!-- Sudah di modifikasi -->
<!-- Submit Field -->
<div class="form-actions center col-12">
    <a href="{!! route('posts.index') !!}" class="btn btn-danger"> <i class="fa fa-close"></i> Batal</a>
    {!! Form::submit('Simpan', ['class' => 'btn btn-green mr-1']) !!}
</div>

@section('scripts')
<!--    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.11/cropper.min.js" integrity="sha512-FHa4dxvEkSR0LOFH/iFH0iSqlYHf/iTwLc5Ws/1Su1W90X0qnxFxciJimoue/zyOA/+Qz/XQmmKqjbubAAzpkA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>-->

    <script type="text/javascript" src="{{ asset('ckeditor/ckeditor.js') }}"></script>
    <script type="text/javascript" src="{{ asset('ckeditor/adapters/jquery.js') }}"></script>

<!--    <script type="module">
        /*import Cropper from './cropperjs';*/

        $('#image-media').on("click", function(e){
            const image = document.getElementById('image-media');
            const cropper = new Cropper(image, {
                aspectRatio: 16 / 9,
                crop(event) {
                    console.log(event.detail.x);
                    console.log(event.detail.y);
                    console.log(event.detail.width);
                    console.log(event.detail.height);
                    console.log(event.detail.rotate);
                    console.log(event.detail.scaleX);
                    console.log(event.detail.scaleY);
                },
            });
        });
    </script>-->

    <script  type="text/javascript">
        setTimeout(function(){
            CKEDITOR.config.enterMode = CKEDITOR.ENTER_BR;
            CKEDITOR.replace( 'content');
        },300);

    </script>
@endsection

