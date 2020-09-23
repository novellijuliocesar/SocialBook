@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <!--Muestra Usuarios -->
            @foreach ($followers as $user)
            <div class="card-body">
                <div class="user-profile">

                    <!--Muestra la imagen de perfil del usuario -->
                    <div class="container-avatar">
                        @if($user->profileimage)
                        <div class="container-avatar">
                            <a href="{{route('profile', ['id' => $user->id])}}">
                                <img class="avatar" src="{{ route('user.avatar', ['fileName' => $user->profileimage]) }}" />
                            </a>
                        </div>
                        @endif
                    </div>

                    <!--Muestra nombre y apellido del usuario -->
                    <div class="user-info">
                        <div class="nickname">
                            <a href="{{route('profile', ['id' => $user->id])}}">
                                {{($user->nickname)}}
                            </a>
                        </div>
                        <div class="user-name">
                            {{$user->name . ' ' . $user->surname}}
                        </div>
                        <!-- Muestra desde cuando esta registrado el usuario -->
                        <div class="user-date">
                            {{'Es usuario ' . \TimeFormat::Since($user->created_at)}}
                        </div>
                        <!-- Muestra cantidad de publicaciones hechas por el usuario -->
                        <div class="user-post">
                            <span class="post-count">{{count($user->posts)}}</span> publicaciones
                        </div>
                        <!-- Muestra cantidad de seguidores -->
                        <div class="user-followers">
                            <span class="followers-count">{{count($user->following)}}</span> seguidores
                        </div>
                        <!-- Muestra cantidad de seguidos por el usuario -->
                        <div class="user-following">
                            <span class="following-count">{{count($user->followers)}}</span> seguidos
                        </div>
                    </div>
                </div>
                <hr />
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection