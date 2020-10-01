@extends('layouts.app')

@section('content')
    <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <!-- Muestra mensaje de error o publicación -->
            @include('includes.message')

            <div class="card">
                <div class="card-header">Crear Publicación</div>
            
                <div class="card-body">
                    <form action="{{ route('post.save') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                    
                        <!-- Campo de Título -->
                        <div class="form-group row">
                            <label for="title" class="col-md-4 col-form-label text-md-right">Título</label>

                            <div class="col-md-6">
                                <input id="title" type="text" name="title" class="form-control"/>

                                @if ($errors->has('title'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!-- Campo de Imagen -->
                        <div class="form-group row">
                            <label for="postimage" class="col-md-4 col-form-label text-md-right">Imagen</label>

                            <div class="col-md-6">
                                <input id="postimage" type="file" name="postimage" class="form-control" required/>

                                @if ($errors->has('postimage'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('postimage') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!-- Campo de Autor -->
                        <div class="form-group row">
                            <label for="author" class="col-md-4 col-form-label text-md-right">Autor</label>

                            <div class="col-md-6">
                                <input id="author" type="text" name="author" class="form-control"/>

                                @if ($errors->has('author'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('author') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!-- Campo de Editorial -->
                        <div class="form-group row">
                            <label for="editorial" class="col-md-4 col-form-label text-md-right">Editorial</label>

                            <div class="col-md-6">
                                <input id="editorial" type="text" name="editorial" class="form-control"/>

                                @if ($errors->has('editorial'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('editorial') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!-- Campo de Páginas -->
                        <div class="form-group row">
                            <label for="pages" class="col-md-4 col-form-label text-md-right">Número de Páginas</label>

                            <div class="col-md-6">
                                <input id="pages" type="text" name="pages" class="form-control"/>

                                @if ($errors->has('pages'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('pages') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!-- Campo de Descripción -->
                        <div class="form-group row">
                            <label for="description" class="col-md-4 col-form-label text-md-right">Descripción</label>

                            <div class="col-md-6">
                                <textarea id="description" name="description" class="form-control"></textarea>

                                @if ($errors->has('description'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!-- Campo de Enviar formulario -->
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Publicar
                                </button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection