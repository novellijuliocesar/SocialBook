@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <!--Muestra la Publicación -->
            @foreach ($posts as $post)
                <div class="card pub-image">
                    <div class="card-header">

                        <!--Muestra la imagen de perfil del usuario -->
                        @if($post->user->profileimage)
                            <div class="container-avatar">
                                <img class="avatar" src="{{ route('user.avatar', ['fileName' => $post->user->profileimage]) }}" />
                            </div>
                        @endif

                        <!--Muestra nombre y apellido del usuario -->
                        <div class="data-user">
                            {{$post->user->name . ' ' . $post->user->surname}}
                            <span class="nickname">
                                {{'  |   ' . $post->user->nickname}}
                            </span>
                        </div>

                    </div>
                    
                    <!--Muestra Título de la publicación -->
                    <div class="title">

                    </div>

                    <!--Muestra Imagen de la publicación -->
                    <div class="card-body">
                        <div class="image-container">
                            <img src="{{route('post.image', ['fileName' => $post->postimage])}}" alt=""/>
                        </div>
                    </div>

                    <!--Muestra Likes de la publicación -->
                    <div class="likes">

                    </div>

                    <!--Muestra Descripción de la publicación -->
                    <div class="description">
                        <span class="nickname">
                        {{$post->user->nickname}}
                        </span>
                        {{' ' . $post->description}}
                    </div>

                    <!--Muestra Comentarios de la publicación -->
                    <div class="comment">

                    </div>

                </div>
            @endforeach

            <!-- Paginación -->
            <div class="clearfix"></div>
            {{$posts->links()}}

        </div>
    </div>
</div>
@endsection
