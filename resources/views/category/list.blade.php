@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

        <!-- Formulario para crear una nueva categoría -->
        <div>

        </div>
        <hr/>

            <!--Muestra Usuarios -->
            @foreach ($categories as $category)
                <div class="card-body">
                    
                <div class="category-container">
                                        
                    <div class="category-item">  
                        {{$category->name}} 
                        <a href="{{route('category.edit', ['id' => $category->id])}}">
                            <i class="far fa-edit edit"></i>
                        </a>
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