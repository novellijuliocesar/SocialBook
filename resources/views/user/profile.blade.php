@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <!-- Muestra datos del usuario -->
            <div class="user-profile">

                <!--Muestra la imagen de perfil del usuario -->
                <div class="container-avatar">
                    @if($user->profileimage)                            
                        <div class="container-avatar">
                            <img class="avatar" src="{{ route('user.avatar', ['fileName' => $user->profileimage]) }}" />
                        </div>
                    @endif
                </div>
                    
                
                <div class="user-info">                

                    <!-- Comprueba si el usuario identificado está siguiendo al usuario del perfil -->
                    <?php $userFollow = false;?>
                    
                    @foreach(Auth::user()->followers as $follower)
                        @if($follower->id == $user->id)
                            <?php $userFollow = true;?>
                        @endif
                    @endforeach

                    <!--Muestra nickname del usuario -->
                    <div class="nickname follow-text">
                        {{($user->nickname)}}
                        @if($user->id != Auth::user()->id)
                        <span class="icons-follow" data-id="{{$user->id}}">
                            @if(!$userFollow)
                            <i class="fas fa-user-plus unfollow"></i>
                            @else
                            <i class="fas fa-user-minus follow"></i>
                            @endif
                        </span>
                        @endif
                    </div>
                    
                    <!--Muestra nombre y apellido del usuario -->
                    <div class="user-name">
                        {{$user->name . ' ' . $user->surname}}
                    </div>
                    <!-- Muestra desde cuando esta registrado el usuario -->
                    <div class="user-date">
                        {{'Es usuario ' . \TimeFormat::Since($user->created_at)}}                      
                    </div>
                    <hr/>
                    <!-- Muestra cantidad de publicaciones hechas por el usuario -->
                    <div class="user-post">
                        <span class="post-count">{{count($user->posts)}}</span> publicaciones
                    </div>

                    <!-- Muestra cantidad de seguidores -->
                    @if(count($user->followers) >= 1)
                    <div class="user-followers">
                        <a href="{{route('user.showFollowers', ['id' => $user->id])}}">
                            <span class="followers-count">{{count($user->followers)}}</span> seguidos
                        </a>
                    </div>
                    @endif

                    <!-- Muestra cantidad de seguidos por el usuario -->
                    @if(count($user->following) >= 1)
                    <div class="user-following">
                        <a href="{{route('user.showFollowing', ['id' => $user->id])}}">
                            <span class="following-count">{{count($user->following)}}</span> seguidores
                        </a>
                    </div>
                    @endif

                </div>

            </div>

            <div class="clearfix"></div>

            <!--Muestra la Publicación -->
            @foreach ($user->posts as $post)
                @include('includes.post', ['post' => $post])
            @endforeach

        </div>
    </div>
</div>
@endsection
