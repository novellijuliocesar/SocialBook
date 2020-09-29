@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <!-- Formulario para crear una nueva categoría -->
            <div class="card-header title">
                Crea una nueva Categoría
            </div>
            <div class="card-body">
                <div>
                    <form action="{{route('category.create')}}" method="POST">
                        @csrf
                        <div class="form-group row">
                            <label for="name" class="col-md-3 col-form-label text-md-right">Nombre</label>
                            <div class="col-md-6">
                                <input type="text" name="name" id="name" class="form-control" required />
                            </div>
                            <input type="submit" value="Crear" class="btn btn-success">
                        </div>
                    </form>
                </div>
                <hr/>
            </div>

            <!--Muestra listado de categorías -->
            <div class="card-header title">
                Listado de categorías
            </div>
            @foreach ($categories as $category)
                    
                <div class="category-container">

                    <div class="category-item">  
                        {{$category->name}}
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