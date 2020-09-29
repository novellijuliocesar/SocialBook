<?php

namespace App\Http\Controllers;

use App\category;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\post;
use App\comment;
use App\like;
use Illuminate\Support\Facades\Auth;
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

        //Recoge todos sus registros de categorías
        $categories = Category::all();

        //Redirige a la página de creación de publicación y le pasa un array con las categorías 
        return view('post.create', compact('categories'));
    }

    //Realiza un registro de una publicación en la Base de Datos
    public function save(Request $request){

        //Recoge el usuario identificado
        $user = \Auth::user();

        //Validación de los datos recibidos
        $validate = $this->validate($request, [
            'title' => 'required|string|max:255',
            'category' => 'required',
            'description' => 'required|string|max:255',
            'postimage' => 'required|image'
        ]);

        //Recoge los datos enviados por el formulario
        $title = $request->input('title');
        $category = $request->input('category');
        $description = $request->input('description');
        $postimage = $request->file('postimage');

        //Asigna nuevos valores al objeto del usuario
        $post = new post;
        $post->user_id = $user->id;
        $post->title = $title;
        $post->category_id = $category;
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

        //Realiza una redirección a la página de la publicación
        return redirect()->route('post.postdetail', ['id' => $post->id]);
        

    }

    //Recupera la imagen de la publicación del disco
    public function getImage($fileName){
        $file = Storage::disk('posts')->get($fileName);
        return new Response($file, 200);
    }

    //Carga la vista de una publicacion
    public function postdetail($id){
        $post = post::find($id);

        return view('post.postdetail', [
            'post' => $post
        ]);
    }

    //Elimina un registro y todos los componentes de una publicación
    public function delete($id){

        //Recoge los datos del usuario identificado
        $user = \Auth::user();

        //Recoge los datos de la publicación a eliminar
        $post = post::find($id);

        if($user && $post && ($post->user->id == $user->id)){

            //Elimina la imagen de la publicación
            Storage::disk('posts')->delete($post->postimage);

            //Elimina el registro de la publicación
            $post->delete();

            $message = array(['message' => 'La publicación ha sido eliminada correctamente']);

        }else{
            $message = array(['message' => 'La publicación no ha sido eliminada']);
        }

        //Realiza una redirección a la página principal
        return redirect()->route('home')->with($message);
    }

    //Modifica los datos de una publicación
    public function edit($id){

        //Recoge los datos del usuario identificado
        $user = Auth::user();

        //Recoge todos sus registros de categorías
        $categories = Category::all();

        //Recoge los datos de la publicación a modificar
        $post = post::find($id);

        if($user && $post && ($post->user->id == $user->id)){

            $edit = true;

            //Renderiza la vista de la edición de la publicación
            return view('post.edit', ['post' => $post, 'edit' => $edit], compact('categories'));
        }else{

            //Redirige a la página principal
            return redirect()->route('home');

        }
    }

    //Guarda la publicación modificada
    public function update(Request $request){

        //Recoge el usuario identificado
        $user = \Auth::user();

        //Validación de los datos recibidos
        $validate = $this->validate($request, [
            'title' => 'string|max:255',
            'category' => 'required',
            'description' => 'string|max:255',
            'postimage' => 'image'
        ]);

        //Recoge los valores de la publicación en edición
        $post_id = $request->input('post_id');
        $title = $request->input('title');
        $category = $request->input('category');
        $description = $request->input('description');
        $postimage = $request->file('postimage');

        //Recoge el objeto de la publicación en edición
        $post = post::find($post_id);

        //Setea el objeto con los nuevos datos
        $post->title = $title;
        $post->category_id = $category;
        $post->description = $description;

        //Recoge el nombre original de la imagen
        $originalName = $post->postimage;

        //Subir imagen de la publicación
        if($postimage){                       

            //Nombra a la nueva imagen con el nombre de la original y la reescribe
            $fileName = $originalName;     

            //Guarda la imagen en la carpeta storage/app/posts
            Storage::disk('posts')->put($fileName, File::get($postimage));

            //Setea el nombre de la imagen de la publicación con el que se guarda en el disco
            $post->postimage = $fileName;            
        }

        //Actualiza el registro de la publicación
        $post->update();

        //Redirecciona a la página del detalle de la publicación actualizada
        return redirect()->route('post.postdetail', ['id' => $post_id])->with(['message', 'Publicación actualizada correctamente']);
 
    }

}
