@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <!--Muestra la Publicación -->
            @foreach ($posts as $post)
                <div class="card pub-image pub-image-detail">
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
                        <a href="{{route('post.postdetail', ['id' => $post->id])}}">

                        </a>
                    </div>

                    <!--Muestra Imagen de la publicación -->
                    <div class="card-body">
                        <div class="image-container">
                            <a href="{{route('post.postdetail', ['id' => $post->id])}}">
                                <img src="{{route('post.image', ['fileName' => $post->postimage])}}" alt=""/>
                            </a>
                        </div>
                    </div>

                    <div class="grid-container">
                        <!--Muestra Botón de Likes de la publicación -->
                        <div class="grid-item">
                            <a href="" class="btn-likes">
                                <i class="far fa-heart"></i>
                            </a>
                        </div>
        
                        <!--Muestra Botón de Comentarios de la publicación -->
                        <div class="grid-item">
                            <a href="{{route('post.postdetail', ['id' => $post->id])}}" class="btn-comments">
                                <i class="far fa-comment"></i>
                            </a>
                        </div>
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
                    
                    <!--Muestra cantidad de comentarios -->
                    @if(count($post->comments)>=1)
                        <div class="comments">
                            <a href="{{route('post.postdetail', ['id' => $post->id])}}">
                                Ver los {{count($post->comments)}} comentarios
                            </a>
                        </div>
                    @endif

                    <!-- Muestra la fecha de la publicación -->
                    <div class="post-date">
                        <a href="{{route('post.postdetail', ['id' => $post->id])}}" title="{{$post->created_at}}">
                            {{\TimeFormat::Since($post->created_at)}}
                        </a>                        
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
