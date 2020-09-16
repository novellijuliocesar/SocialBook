<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\post;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{
    //Controla que el acceso a los métodos del controlador solo para usuarios identificados
    public function __construct()
    {
        $this->middleware('auth');
    }

    //Carga la vista de creación de publicación
    public function create(){
        return view('post.create');
    }

    //Realiza un registro de una publicación en la Base de Datos
    public function save(Request $request){

        //Recoge el usuario identificado
        $user = \Auth::user();

        //Validación de los datos recibidos
        $validate = $this->validate($request, [
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'postimage' => 'required|image'
        ]);

        //Recoge los datos enviados por el formulario
        $title = $request->input('title');
        $description = $request->input('description');
        $postimage = $request->file('postimage');

        //Asigna nuevos valores al objeto del usuario
        $post = new post;
        $post->user_id = $user->id;
        $post->title = $title;
        $post->description = $description;

        //Subir imagen de la publicación
        if($postimage){           
            //Extrae la extensión del archivo y concatena con el nickname del usuario para darle un nombre único a la imagen
            $ext = $postimage->getClientOriginalExtension();
            $imageName = $user->nickname;
            $fileName = $imageName . '' . time() . '.' . $ext;         

            //Guarda la imagen en la carpeta storage/app/posts
            Storage::disk('posts')->put($fileName, File::get($postimage));

            //Setea el nombre de la imagen de la publicación con el que se guarda en el disco
            $post->postimage = $fileName;            
        }

        //Ejecuta la consulta y modifica los datos en la Base de Datos
        $post->save();

        //Realiza una redirección con un mensaje de actualización correctamente realizada
        return redirect()->route('post.create')->with(['message' => 'Publicación guardada correctamente']);

    }

    //Recupera la imagen de la publicación del disco
    public function getImage($fileName){
        $file = Storage::disk('posts')->get($fileName);
        return new Response($file, 200);
    }

}
