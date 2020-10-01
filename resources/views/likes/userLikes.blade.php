@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card-header">
                <i class="far fa-smile"></i> Mis Publicaciones favoritas
            </div>
            <br/>

            <!-- Muestra todas las publicaciones a las que el usuario les ha dado like -->
            @foreach($likes as $like)
                @include('includes.post', ['post' => $like->posts])
            @endforeach            
                
            <!-- Paginación -->
            <div class="clearfix"></div>
            {{$likes->links()}}

        </div>
    </div>
</div>
@endsection
