<div class="card pub-image pub-image-detail">
    <div class="card-header">

        <!--Muestra la imagen de perfil del usuario -->        
        @if($post->user->profileimage)
            <a href="{{route('profile', ['id' => $post->user->id])}}">
                <div class="container-avatar">
                    <img class="avatar" src="{{ route('user.avatar', ['fileName' => $post->user->profileimage]) }}" />
                </div>
            </a>
        @endif

        <!--Muestra nickname del usuario -->
        <div class="data-user">
            <a href="{{route('profile', ['id' => $post->user->id])}}">
                <span class="nickname">
                    {{$post->user->nickname}}
                </span>
            </a>
        </div>

    </div>


    <!--Muestra Imagen de la publicación -->
    <div class="card-body">
        <div class="image-container">
            <a href="{{route('post.postdetail', ['id' => $post->id])}}">
                <img src="{{route('post.image', ['fileName' => $post->postimage])}}" alt="" />
            </a>
        </div>
    </div>

    <div class="grid-container">
        <!--Muestra Botón de Likes de la publicación -->
        <div class="grid-item">

            <!-- Comprueba si el usuario identificado ha registrado un like sobre la publicación -->
            <?php $userLike = false; ?>
            @foreach($post->likes as $like)
            @if($like->user->id == Auth::user()->id)
            <?php $userLike = true; ?>
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

        <!--Muestra Botón de Comentarios de la publicación -->
        <div class="grid-item">
            <a href="{{route('post.postdetail', ['id' => $post->id])}}" class="btn-comments">
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

    <!-- Muestra la fecha de la publicación -->
    <div class="post-date">
        <a href="{{route('post.postdetail', ['id' => $post->id])}}" title="{{$post->created_at}}">
            {{\TimeFormat::Since($post->created_at)}}
        </a>
    </div>

</div>