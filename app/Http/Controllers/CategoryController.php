<?php

namespace App\Http\Controllers;

use App\category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    //Recoge y muestra en una pantalla todas las categorías con las que cuenta la plataforma
    public function showList(){

        //Recoge todas las categorías de la plataforma
        $categories = category::orderBy('name', 'asc')->paginate(20);
        
        //Redirecciona a la página de la vista con los resultados
        return view('category.list', ['categories' => $categories]);        
    }
}
