<!-- Title Field -->
<div class="col-sm-12">
    {!! Form::label('title', 'Title:') !!}
    <p>{{ $kegiatan->title }}</p>
</div>

<!-- Content Field -->
<div class="col-sm-12">
    {!! Form::label('content', 'Content:') !!}
    <p>{{ $kegiatan->content }}</p>
</div>

<!-- Users Created Id Field -->
<div class="col-sm-12">
    {!! Form::label('users_created_id', 'Users Created Id:') !!}
    <p>{{ $kegiatan->users_created_id }}</p>
</div>

<!-- Users Updated Id Field -->
<div class="col-sm-12">
    {!! Form::label('users_updated_id', 'Users Updated Id:') !!}
    <p>{{ $kegiatan->users_updated_id }}</p>
</div>

<!-- Slug Field -->
<div class="col-sm-12">
    {!! Form::label('slug', 'Slug:') !!}
    <p>{{ $kegiatan->slug }}</p>
</div>

<!-- Schedule Date Field -->
<div class="col-sm-12">
    {!! Form::label('schedule_date', 'Schedule Date:') !!}
    <p>{{ $kegiatan->schedule_date }}</p>
</div>

<!-- Schedule Time Field -->
<div class="col-sm-12">
    {!! Form::label('schedule_time', 'Schedule Time:') !!}
    <p>{{ $kegiatan->schedule_time }}</p>
</div>

<!-- Tipe Acara Field -->
<div class="col-sm-12">
    {!! Form::label('tipe_acara', 'Tipe Acara:') !!}
    <p>{{ $kegiatan->tipe_acara }}</p>
</div>

<!-- Location Field -->
<div class="col-sm-12">
    {!! Form::label('location', 'Location:') !!}
    <p>{{ $kegiatan->location }}</p>
</div>

