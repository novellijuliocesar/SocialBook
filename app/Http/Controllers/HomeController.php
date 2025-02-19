<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\post;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    //Controla que el acceso a los métodos del controlador solo para usuarios identificados
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    
    //Muestra las imagenes en el index
    public function index()
    {
        //Recoge todas las publicaciones ordenadas de manera descendiente por su id
        $posts = post::orderBy('id', 'desc')->paginate(10);

        //Pasa las publicaciones a la vista del index
        return view('home', [
            'posts' => $posts
        ]);
    }
}
