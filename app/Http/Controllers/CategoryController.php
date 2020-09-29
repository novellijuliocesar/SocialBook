<?php

namespace App\Http\Controllers;

use App\category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{

    //Controla que el acceso a los métodos del controlador solo para usuarios identificados
    public function __construct()
    {
        $this->middleware('auth');
    }

    //Recoge y muestra en una pantalla todas las categorías con las que cuenta la plataforma
    public function showList(){

        //Recoge los datos del usuario identificado
        $user = Auth::User();

        if($user->role == 'admin'){

            //Recoge todas las categorías de la plataforma
            $categories = category::orderBy('name', 'asc')->paginate(20);
            
            //Redirecciona a la página de la vista con los resultados
            return view('category.list', ['categories' => $categories]);        

        }else{

            //Redirecciona a la página principal
            return view('home');
        }
    }

    //Crea un nuevo registro de categoría en la base de datos
    public function create(Request $request){

        //Validación de los datos recibidos
        $validate = $this->validate($request, [
            'name' => 'required|string|max:255'
        ]);

        //Recoje el nombre de la categoría ingresado en el formulario
        $name = $request->input('name');

        //Crea y asigna nombre a la categoría
        $category = new category;
        $category->name = $name;

        //Guarda el nuevo registro de categoría en la base de datos
        $category->save();

        //Realiza una redirección a la página de categorías
        return redirect()->route('category.list')->with(['message','La categoría ha sido creada correctamente']);
    }

    //Elimina un registro y todos los componentes de una publicación
    public function delete($id){

        //Recoge los datos del usuario identificado
        $user = Auth::user();

        //Recoge los datos de la categoría a eliminar
        $category = category::find($id);

        //Elimina el registro de la categoría
        $category->delete();

        //Realiza una redirección a la página de categorías
        return redirect()->route('category.list')->with(['message','La categoría ha sido eliminada correctamente']);
    }
}
