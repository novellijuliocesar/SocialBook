<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\like;

class LikeController extends Controller
{
    //Controla que el acceso a los métodos del controlador solo para usuarios identificados
    public function __construct()
    {
        $this->middleware('auth');
    }

    //Registra un like en la Base de Datos
    public function like($post_id){

        //Recoge el objeto de usuario
        $user = \Auth::user();

        //Comprueba si existe un registro de like en la Base de Datos
        $likeExist = Like::WHERE('user_id', $user->id)
                         ->WHERE('post_id', $post_id)
                         ->count();

        //Si no existe un registro de like previo guarda el nuevo registro
        if($likeExist == 0){

            //Crea el objeto de like
            $like = new Like();

            //Setea los valores del objeto
            $like->user_id = $user->id;
            $like->post_id = (int)$post_id;

            //Guarda un registro de like en la Base de Datos
            $like->save();

            //Recoge la cantidad de likes de la publicación
            $likeCount = like::WHERE('post_id', $post_id)->count();

            //Devuelve un json con los datos del registro
            return response()->json([
                'like' => $like,
                'count' => $likeCount,
                'message' => 'Has realizado un like'
            ]);
        }else{

            //Devuelve un json con el mensaje de like existente
            return response()->json([                
                'message' => 'Ya existe el registro del like'
            ]);
        }
        
    }

    //Elimina un like de la Base de Datos
    public function dislike($post_id){

        //Recoge el objeto de usuario
        $user = \Auth::user();

        //Recoge el registro de like en la Base de Datos
        $like = Like::WHERE('user_id', $user->id)
                    ->WHERE('post_id', $post_id)
                    ->first();

        //Si existe un registro de like previo lo elimina de la Base de Datos
        if($like){

            //Elimina un registro de like en la Base de Datos
            $like->delete();

            //Recoge la cantidad de likes de la publicación
            $likeCount = like::WHERE('post_id', $post_id)->count();

            //Devuelve un json con los datos del registro
            return response()->json([
                'like' => $like,
                'count' => $likeCount,
                'message' => 'Has realizado un dislike'
            ]);
        }else{

            //Devuelve un json con el mensaje de like inexistente
            return response()->json([
                'message' => 'No existe el registro del like'
            ]);
        }
        
    }

    //Recoge la cantidad de likes en una publicación y la devuelve en un json
    public function countLikes($post_id){

        //Comprueba si existe un registro de like en la Base de Datos
        $countLikes = Like::WHERE('post_id', $post_id)
                         ->count();

        //Si existe registros de likes devuelve la cantidad
        if($countLikes > 0){

            //Devuelve un json con los datos del registro
            return response()->json([
                'count' => $countLikes
            ]);
        }else{

            //Devuelve un json con el mensaje de falta de registros de likes
            return response()->json([
                'message' => 'Ya existe registro de likes'
            ]);
        }
        
    }
}
