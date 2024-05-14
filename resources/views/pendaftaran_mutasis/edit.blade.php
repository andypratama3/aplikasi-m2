@extends('layouts.app')

@section('content')
    <div class="content-body">
        <section id="horizontal-form-layouts">
            <div class="row">
                <div class="col-md-12">
                    <div class="card overflow-hidden">
                        <div class="card-content">
                            <div class="media align-items-stretch">
                                <div class="bg-indigo p-2 media-middle">
                                    <i class="fa fa-pencil-square font-large-2 text-white"></i>
                                </div>
                                <div class="media-body p-1">
                                    <span class="indigo font-medium-5">Perubahan Pendaftaran Mutasi</span><br>
                                    <span style="margin-top: -5px">Melakukan Perubahan Pendaftaran Mutasi </span>
                                    @include('flash::message')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    @include('adminlte-templates::common.errors')
                    <div class="card">
                        <div class="card-content collpase show">
                            <div class="card-body">
                                {!! Form::model($pendaftaranMutasi, [
                                    'route' => ['pendaftaranMutasis.update', $pendaftaranMutasi->id],
                                    'method' => 'patch',
                                    'files' => true,
                                ]) !!}
                                <div class="form-body row">
                                    @include('pendaftaran_mutasis.fields')
                                    <div class="form-actions col-md-12 center">
                                        <a href="{{ route('pendaftaranMutasis.index') }}" class="btn btn-default">Batal</a>
                                        <button type="submit" class="btn btn-primary" name="save_button">Save</button>
                                        <button type="submit" class="btn btn-success" name="ajukan_button">Ajukan
                                            Mutasi</button>
                                    </div>
                                </div>
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
