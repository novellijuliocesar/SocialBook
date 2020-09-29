@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

        <!-- Formulario para crear una nueva categoría -->
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
            @foreach ($categories as $category)
                <div class="card-body">
                    
                <div class="grid-container">
                    
                    <div class="grid-item">  
                        {{$category->name}} 
                    </div>  

                    <!--Muestra opción para editar la categoria -->
                    <div class="grid-item">
                        <a href="{{route('category.edit', ['id' => $category->id])}}">
                            <i class="far fa-edit edit"></i>
                        </a>
                    </div>

                    <!--Muestra opción para eliminar la categoria -->
                    <div class="grid-item">
                        <a href="{{route('category.delete', ['id' => $category->id])}}">
                            <i class="far fa-trash-alt delete"></i>
                        </a>
                    </div>
                                  
                </div>
            @endforeach
                
            <!-- Paginación -->
            <div class="clearfix"></div>
            {{$categories->links()}}

        </div>
    </div>
</div>
@endsection