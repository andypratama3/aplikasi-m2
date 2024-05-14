@extends('layouts.app')

@section('content')
    <div class="content-body">
        <section id="horizontal-form-layouts">
            <div class="row">
                <div class="col-md-12">
                    <div class="card overflow-hidden rounded-2">
                        <div class="card-content">
                            <div class="media align-items-stretch">
                                <div class="bg-indigo p-2 media-middle">
                                    <i class="fa fa-pencil-square font-large-2 text-white"></i>
                                </div>
                                <div class="media-body p-1">
                                    <span class="indigo font-medium-5 text-bold-600">Perubahan Kategori Page</span><br>
                                    <span style="margin-top: -5px">Melakukan Perubahan Kategori Page</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    @include('adminlte-templates::common.errors')
                    <div class="card overflow-hidden rounded-2">
                        <div class="card-content collpase show">
                            <div class="card-body">
                                {!! Form::model($pageCategory, ['route' => ['pageCategories.update', $pageCategory->id], 'method' => 'patch']) !!}
                                <div class="row">
                                    @include('page_categories.fields')
                                </div>
                                <div class="card-footer text-center">
                                    <a href="{{ route('pageCategories.index') }}" class="btn btn-danger rounded-2"> Batal </a>
                                    {!! Form::submit('Simpan Perubahan', ['class' => 'btn btn-green rounded-2']) !!}
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

