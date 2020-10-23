<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\comment;

class CommentController extends Controller
{
    //Controla que el acceso a los métodos del controlador solo para usuarios identificados
    public function __construct()
    {
        $this->middleware('auth');
    }

    //Registra un comentario en la Base de Datos
    public function save(Request $request){

        //Recoge el usuario identificado
        $user = \Auth::user();

        //Validación del formulario
        $validate = $this->validate($request, [
            'post_id' => 'required|integer',
            'content' => 'required|string|max:255'
        ]);

        //Recoge los datos enviados por el formulario
        $post_id = $request->input('post_id');
        $content = $request->input('content');

        //Asigna nuevos valores al objeto del usuario
        $comment = new comment();
        $comment->user_id = $user->id;
        $comment->post_id = $post_id;
        $comment->content = $content;

        //Ejecuta la consulta y guarda el comentario en la Base de Datos
        $comment->save();

        //Realiza una redirección a la publicación
        return redirect()->route('post.postdetail', ['id' => $post_id]);

    }
}
