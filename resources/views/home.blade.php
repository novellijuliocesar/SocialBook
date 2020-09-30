@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
        
            <!-- Buscador de usuarios -->
            <div class="card-body">
                <div class="finder">
                    <form action="{{route('user.showUsers')}}" method="GET" id="search-users">   
                        @csrf
                        <div class="form-group row"> 
                            <div class="col-md-6">
                                <input type="text" id="search" placeholder="Buscar..." class="form-control"/>
                            </div>    
                            <div class="form-group col btn-search">
                                <input type="submit" value="Buscar" class="btn btn-success">
                            </div> 
                        </div>    
                    </form>
                </div>
            </div>

            <!--Muestra la Publicación -->
            @foreach ($posts as $post)
                    @include('includes.post', ['post' => $post])
            @endforeach
                
            <!-- Paginación -->
            <div class="clearfix"></div>
            {{$posts->links()}}

        </div>
    </div>
</div>
@endsection
