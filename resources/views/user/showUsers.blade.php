@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

        <!-- Buscador de usuarios -->
        <form action="{{route('user.showUsers')}}" method="GET" id="search-users">   
            <div class="row searchForm"> 
                <div class="form-group col">
                    <input type="text" id="search" placeholder="Buscar..." class="form-control"/>
                </div>    
                <div class="form-group col btn-search">
                    <input type="submit" value="Buscar" class="btn btn-success">
                </div> 
            </div>    
        </form>
        <hr/>

            <!--Muestra Usuarios -->
            @foreach ($users as $user)
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
                    <hr/>
                </div>
            @endforeach
                
            <!-- Paginación -->
            <div class="clearfix"></div>
            {{$users->links()}}

        </div>
    </div>
</div>
@endsection
