@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <!--Muestra la Publicación -->
                <div class="card pub-image">
                    <div class="card-header">

                        <!--Muestra la imagen de perfil del usuario -->
                        <a href="">
                            @if($post->user->profileimage)
                                <div class="container-avatar">
                                    <img class="avatar" src="{{ route('user.avatar', ['fileName' => $post->user->profileimage]) }}" />
                                </div>
                            @endif
                        </a>

                        <!--Muestra nombre y apellido del usuario -->
                        <div class="data-user">
                            {{$post->user->name . ' ' . $post->user->surname}}
                            <a href="">
                                <span class="nickname">
                                    {{'  |   ' . $post->user->nickname}}
                                </span>
                            </a>
                        </div>

                    </div>
                    
                    <!--Muestra Título de la publicación -->
                    <div class="title">
                        <a href="">

                        </a>
                    </div>

                    <!--Muestra Imagen de la publicación -->
                    <div class="card-body">
                        <div class="image-container">
                            <a href="">
                                <img src="{{route('post.image', ['fileName' => $post->postimage])}}" alt=""/>
                            </a>
                        </div>
                    </div>

                    <div class="grid-container">
                        <!--Muestra Likes de la publicación -->
                        <div class="grid-item">
                            <a href="" class="btn-likes">
                                <i class="far fa-heart"></i>
                            </a>
                        </div>
        
                        <!--Muestra Comentarios de la publicación -->
                        <div class="grid-item">
                            <a href="" class="btn-comments">
                                <i class="far fa-comment"></i>
                            </a>
                        </div>
                    </div>

                    <!--Muestra cantidad de comentarios -->
                    <div class="comments">
                        <a href="">
                            @if(count($post->comments)>=1)
                                Ver los {{count($post->comments)}} comentarios
                            @endif
                        </a>
                    </div>
                    
                    <!--Muestra Descripción de la publicación -->
                    <div class="description">
                        <a href="">
                            <span class="nickname">
                                {{$post->user->nickname}}
                            </span>
                        </a>                        
                        {{' ' . $post->description}}
                    </div>
                    
                </div>

        </div>
    </div>
</div>
@endsection
