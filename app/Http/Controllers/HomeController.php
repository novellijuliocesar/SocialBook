<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\post;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
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
