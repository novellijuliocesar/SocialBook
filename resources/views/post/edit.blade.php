@extends('layouts.app')

@section('content')
    <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <!-- Muestra mensaje de error o publicación -->
            @include('includes.message')

            <div class="card">
                <div class="card-header">Editar Publicación</div>

                <!-- Muestra la imagen original -->
                <div class="card-body">
                    <div class="image-container">
                        <img src="{{ route('post.image', ['fileName' => $post->postimage]) }}" alt=""/>
                    </div>
            
                    <div class="form">
                        <form action="{{route('post.update')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            
                            <!-- Envía la id de la publicación en edición -->
                            <input type="hidden" name="post_id" value="{{$post->id}}"/>
                        
                            <!-- Campo de Título -->
                            <div class="form-group row">
                                <label for="title" class="col-md-4 col-form-label text-md-right">Título</label>

                                <div class="col-md-6">
                                    <input id="title" type="text" name="title" class="form-control" value="{{$post->title}}"/>

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
                                    
                                    <input id="postimage" type="file" name="postimage" class="form-control" value="{{$post->postimage}}"/>

                                    @if ($errors->has('postimage'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('postimage') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <!-- Campo de Descripción -->
                            <div class="form-group row">
                                <label for="description" class="col-md-4 col-form-label text-md-right">Descripción</label>

                                <div class="col-md-6">
                                    <textarea id="description" name="description" class="form-control">{{$post->description}}</textarea>

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
                                        Guardar cambios
                                    </button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection