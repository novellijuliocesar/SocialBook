@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <!-- Muestra un mensaje y accesos a búsquedas en caso de no tener aún contenido que visualizar -->
            @if(count(Auth::User()->followers) == 0)
                <div class="card-header">
                    <i class="fas fa-exclamation-circle"></i> Aún no sigues ninguna cuenta
                </div>    
                <div class="card-body">
                    <!-- Redirecciona a la página de búsqueda de usuarios -->
                    <div class="nav-item">
                        <a class="nav-link" href="{{ route('user.showUsers') }}" title="Buscar">
                        <i class="fas fa-search"></i> Descubre nuevas cuentas
                        </a>
                    </div>

                    <!-- Redirecciona a la página general -->
                    <div class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}" title="Global">
                        <i class="fas fa-globe"></i> Descubre nuevas publicaciones
                        </a>
                    </div>
                    
                    <!-- Redirecciona a la página de creación de una publicación -->
                    <div class="nav-item">
                        <a class="nav-link" href="{{ route('post.create') }}" title="Subir">
                            <i class="fas fa-arrow-up"></i> Crea una publicación
                        </a>
                    </div>
                </div>   
            
            @endif

            <!--Muestra la Publicaciones de los usuarios seguidos por el usuario identificado-->            
            @foreach ($posts as $post)                

                @foreach($users as $user)
                    @if($post->user_id == $user->id)
                        @include('includes.post', ['post' => $post])
                    @endif
                @endforeach

            @endforeach

        </div>
    </div>
</div>
@endsection
