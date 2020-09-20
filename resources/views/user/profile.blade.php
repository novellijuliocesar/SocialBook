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
                    
                <!--Muestra nombre y apellido del usuario -->
                <div class="user-info">
                    <div class="nickname">
                        {{($user->nickname)}}
                    </div>
                    <div class="user-post">
                        <span class="post-count">{{count($user->posts)}}</span> publicaciones
                    </div>
                    <div class="user-name">
                        {{$user->name . ' ' . $user->surname}}
                    </div>
                    <div class="user-date">
                        {{'Es usuario ' . \TimeFormat::Since($user->created_at)}}                      
                    </div>
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
