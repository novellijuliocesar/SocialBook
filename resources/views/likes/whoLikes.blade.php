
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

        <!--Muestra Usuarios -->
            @foreach ($whoLikes as $userLike)
                <div class="card-body">
                    <div class="user-profile">

                        <!--Muestra la imagen de perfil del usuario -->
                        <div class="container-avatar">
                            @if($userLike->user->profileimage)                            
                                <div class="container-avatar">
                                    <a href="{{route('profile', ['id' => $userLike->user->id])}}">
                                        <img class="avatar" src="{{ route('user.avatar', ['fileName' => $userLike->user->profileimage]) }}" />
                                    </a>
                                </div>
                            @endif
                        </div>
                            
                        <!--Muestra nombre y apellido del usuario -->
                        <div class="user-info">

                            <!-- Comprueba si el usuario identificado está siguiendo al usuario del perfil -->
                            <?php $userFollow = false;?>
                            @foreach(Auth::user()->followers as $follower)
                                @if($follower->id == $userLike->user->id)
                                    <?php $userFollow = true;?>
                                @endif
                            @endforeach

                            <!--Muestra nickname del usuario -->
                            <div class="nickname follow-text">
                                <a href="{{route('profile', ['id' => $userLike->user->id])}}">
                                    {{($userLike->user->nickname)}}
                                </a>
                                @if($userLike->user->id != Auth::user()->id)
                                <span class="icons-follow" data-id="{{$userLike->user->id}}">
                                    @if(!$userFollow)
                                    <i class="fas fa-user-plus unfollow"></i>
                                    @else
                                    <i class="fas fa-user-minus follow"></i>
                                    @endif
                                </span>
                                @endif
                            </div>

                            <div class="user-name">
                                {{$userLike->user->name . ' ' . $userLike->user->surname}}
                            </div>
                            <!-- Muestra desde cuando esta registrado el usuario -->
                            <div class="user-date">
                                {{'Es usuario ' . \TimeFormat::Since($userLike->user->created_at)}}                      
                            </div>
                            <!-- Muestra cantidad de publicaciones hechas por el usuario -->
                            <div class="user-post">
                                <span class="post-count">{{count($userLike->user->posts)}}</span> publicaciones
                            </div>

                            <!-- Muestra cantidad de seguidores -->
                            @if(count($userLike->user->followers) >= 1)
                            <div class="user-followers">
                                <a href="{{route('user.showFollowers', ['id' => $userLike->user->id])}}">
                                    <span class="followers-count">{{count($userLike->user->followers)}}</span> seguidos
                                </a>
                            </div>
                            @endif

                            <!-- Muestra cantidad de seguidos por el usuario -->
                            @if(count($userLike->user->following) >= 1)
                            <div class="user-following">
                                <a href="{{route('user.showFollowing', ['id' => $userLike->user->id])}}">
                                    <span class="following-count">{{count($userLike->user->following)}}</span> seguidores
                                </a>
                            </div>
                            @endif
                        </div>
                    </div>
                    <hr/>
                </div>
            @endforeach
                
            <!-- Paginación -->
            <div class="clearfix"></div>
            {{$whoLikes->links()}}

        </div>
    </div>
</div>
@endsection
