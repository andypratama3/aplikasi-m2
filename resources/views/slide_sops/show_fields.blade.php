<div class="col-sm-12">
    {!! Form::label('gambar_slide', 'Gambar:') !!}
    @if ($slideSop->hasMedia('gambar_slide'))
        <ul>
            @foreach ($slideSop->getMedia('gambar_slide') as $media)
                <li>
                    <img src="{{ $media->getUrl() }}" alt="Gambar Slide" width="500px">
                </li>
            @endforeach
        </ul>
    @else
        <p> - Belum ada file</p>
    @endif
</div>


<!-- Halaman Field -->
<div class="col-sm-12">
    {!! Form::label('halaman', 'Halaman:') !!}
    <p>{{ $slideSop->halaman }}</p>
</div>

<!-- Description Field -->
<div class="col-sm-12">
    {!! Form::label('description', 'Description:') !!}
    <p>{{ $slideSop->description }}</p>
</div>

