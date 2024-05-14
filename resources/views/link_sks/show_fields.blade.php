<!-- Link Field -->
<div class="col-sm-12">
    {!! Form::label('link', 'Link:') !!}
    <p>{{ $linkSk->link }}</p>
</div>

<!-- Dari Tanggal Field -->
<div class="col-sm-12">
    {!! Form::label('dari_tanggal', 'Dari Tanggal:') !!}
    <p>{{ $linkSk->dari_tanggal?->format('d/m/Y') ?? '' }}</p>
</div>

<!-- Sampai Tanggal Field -->
<div class="col-sm-12">
    {!! Form::label('sampai_tanggal', 'Sampai Tanggal:') !!}
    <p>{{ $linkSk->sampai_tanggal?->format('d/m/Y') ?? '' }}</p>
</div>

