@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <!--Muestra la Publicación -->
            <div class="card pub-image">
                <div class="card-header">

                    <!--Muestra la imagen de perfil del usuario -->
                    @if($post->user->profileimage)                            
                        <a href="{{route('profile', ['id' => $post->user->id])}}">
                            <div class="container-avatar">
                                <img class="avatar" src="{{ route('user.avatar', ['fileName' => $post->user->profileimage]) }}" />
                            </div>
                        </a>
                    @endif

                    <!--Muestra nombre y apellido del usuario -->
                    <div class="data-user">
                        {{$post->user->name . ' ' . $post->user->surname}}
                        <a href="{{route('profile', ['id' => $post->user->id])}}">
                            <span class="nickname">
                                {{'  |   ' . $post->user->nickname}}
                            </span>
                        </a>
                    </div>

                </div>

                <!--Muestra Imagen de la publicación -->
                <div class="card-body">
                    <div class="image-container">
                        <a href="">
                            <img src="{{ route('post.image', ['fileName' => $post->postimage]) }}" alt=""/>
                        </a>
                    </div>
                </div>

                <div class="grid-container">

                    <!--Muestra Likes de la publicación -->
                    <div class="grid-item">                        
                        <!-- Comprueba si el usuario identificado ha registrado un like sobre la publicación -->
                        <?php $userLike = false;?>
                        @foreach($post->likes as $like)
                            @if($like->user->id == Auth::user()->id)
                                <?php $userLike = true;?>
                            @endif
                        @endforeach
                        
                        <div class="icons-like" data-id="{{$post->id}}">
                                @if($userLike)
                                    <i class="fas fa-heart like"></i>
                                @else
                                    <i class="far fa-heart dislike"></i>
                                @endif
                        </div>                        
                    </div>
    
                    <!--Muestra Comentarios de la publicación -->
                    <div class="grid-item">
                        <a href="" class="btn-comments">
                            <i class="far fa-comment"></i>
                        </a>
                    </div>

                    @if(Auth::user()->id == $post->user_id)
                        <!--Muestra opción para editar la publicación -->
                        <div class="grid-item">
                            <a href="{{route('post.edit', ['id' => $post->id])}}">
                                <i class="far fa-edit edit"></i>
                            </a>
                        </div>

                        <!--Muestra opción para eliminar la publicación -->
                        <div class="grid-item">
                            <a href="{{route('post.delete', ['id' => $post->id])}}">
                                <i class="far fa-trash-alt delete"></i>
                            </a>
                        </div>
                    @endif

                </div>

                <!-- Muestra la cantidad de likes de la publicación -->
                @if(count($post->likes) >= 1)
                    <div class="count-likes">
                        <a href="">
                            <span class="countLikes">{{count($post->likes)}} Me gustas</span>    
                        </a>
                    </div>
                @endif                

                <!--Muestra Descripción de la publicación -->
                <div class="description">
                    <a href="{{route('profile', ['id' => $post->user->id])}}">
                        <span class="nickname">
                            {{$post->user->nickname}}
                        </span>
                    </a>                        
                    {{' ' . $post->description}}
                </div>

                <!--Muestra cantidad de comentarios -->
                @if(count($post->comments) >= 1)
                    <div class="count-comments">
                        <a href="{{ route('post.postdetail', ['id' => $post->id]) }}">
                            Ver los {{count($post->comments)}} comentarios
                        </a>
                    </div>
                @endif

                <!-- Lista los comentarios de la publicación -->
                @if(count($post->comments) >= 1)
                    @foreach($post->comments as $comment)
                        <div class="description">
                            <a href="{{route('profile', ['id' => $comment->user->id])}}">
                                <span class="nickname">
                                    {{$comment->user->nickname . ' '}}
                                </span>
                            </a>
                            <span class="comment">
                                {{$comment->content}}
                            </span>
                            
                        </div>
                    @endforeach
                @endif

                <!-- Muestra la fecha de la publicación -->
                <div class="post-date">
                    <a href="{{route('post.postdetail', ['id' => $post->id])}}" title="{{$post->created_at}}">
                        {{\TimeFormat::Since($post->created_at)}}
                    </a>                        
                </div>

                <!-- Muestra el formulario de comentarios -->
                <div class="comments">
                    <form method="POST" action="{{ route('comment.save') }}">
                        @csrf

                        <input type="hidden" name="post_id" value="{{$post->id}}"/>
                        <textarea  class="form-control" name="content" required></textarea>

                        @if ($errors->has('content'))
                            <span role="alert">
                                <strong>{{ $errors->first('content') }}</strong>
                            </span>
                        @endif

                        <button type="submit" class="btn btn-send">
                            Publicar
                        </button>
                    </form>
                </div>
                
            </div>

        </div>
    </div>
</div>
@endsection
