<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FollowerController extends Controller
{
    //Controla que el acceso a los métodos del controlador solo para usuarios identificados
    public function __construct()
    {
        $this->middleware('auth');
    }    

    //Registra un seguidor en la Base de Datos
    public function follow($user_id){        

        //Recoge los datos del usuario
        $user = \Auth::user();

        //Guarda el registro
        $user->followers()->sync($user_id, false);
    }

    //Elimina un registro de seguidor de la Base de Datos
    public function unfollow($user_id){

        
        //Recoge los datos del usuario
        $user = \Auth::user();

        //Elimina el registro
        $user->followers()->detach($user_id);
    }
}
