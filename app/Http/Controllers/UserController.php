<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class UserController extends Controller
{
    //Controla que el acceso a los métodos del controlador solo para usuarios identificados
    public function __construct()
    {
        $this->middleware('auth');
    }

    //Carga la vista de modificación de datos del usuario
    public function config(){
        return view('user.config');
    }

    //Realiza modificación de un registro de Usuario en la Base de Datos
    public function update(Request $request){

        //Recoge el usuario identificado
        $user = \Auth::user();
        $id = $user->id;
        
        //Validación de los datos recibidos
        $validate = $this->validate($request, [
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'nickname' => 'required|string|max:255|unique:users,nickname,'.$id,
            'email' => 'required|string|email|max:255|unique:users,email,'.$id,
            'profileimage' => 'image'
        ]);

        //Recoge los datos enviados por el formulario
        $name = $request->input('name');
        $surname = $request->input('surname');
        $nickname = $request->input('nickname');
        $email = $request->input('email');
        $profileimage = $request->file('profileimage');

        //Asigna nuevos valores al objeto del usuario
        $user->name = $name;
        $user->surname = $surname;
        $user->nickname = $nickname;
        $user->email = $email;   

        //Subir imagen de perfil
        if($profileimage){           
            //Extrae la extensión del archivo y concatena con el nickname del usuario para darle un nombre único a la imagen
            $ext = $profileimage->getClientOriginalExtension();
            $imageName = $user->nickname;
            $fileName = $imageName . '.' . $ext;         

            //Guarda la imagen en la carpeta storage/app/users
            Storage::disk('users')->put($fileName, File::get($profileimage));

            //Setea el nombre de la imagen de perfil con el que se guarda en el disco
            $user->profileimage = $fileName;            
        }

        //Ejecuta la consulta y modifica los datos en la Base de Datos
        $user->update();

        //Realiza una redirección con un mensaje de actualización correctamente realizada
        return redirect()->route('user.config')->with(['message' => 'Usuario actualizado correctamente']);
    }

    //Recupera la imagen de perfil de Usuario del disco
    public function getImage($fileName){
        $file = Storage::disk('users')->get($fileName);
        return new Response($file, 200);
    }

    //Carga la vista del perfil del usuario
    public function profile($id){

        //Recoge los datos del usuario que llega por url
        $user = User::find($id);

        //Devuelve los datos a la vista de perfil de usuario
        return view('user.profile', [
            'user' => $user
        ]);
    }

    //Recoge y muestra en una pantalla todos o los usuarios buscados en la plataforma
    public function showUsers($search = null){

        if($search == null){
            //Recoge todos los usuarios de la plataforma
            $users = User::orderBy('id', 'desc')->paginate(5);
        }else{            
            //Recoge todos los usuarios de la plataforma que coincidan con la busqueda
            $users = User::WHERE('nickname', 'LIKE', '%' . $search . '%')
                        ->orWHERE('name', 'LIKE', '%' . $search . '%')
                        ->orWHERE('surname', 'LIKE', '%' . $search . '%')
                        ->orderBy('id', 'desc')->paginate(5);
        }

        //Redirecciona a la página de la vista con los resultados
        return view('user.showUsers', ['users' => $users]);        
    }

    //Recoge los seguidores de un usuario
    public function showFollowers($id){

        //Recoge los datos del usuario que llega por url
        $user = user::find($id);

        //Recoge los seguidores del usuario
        $followers = $user->followers;

        if(count($followers) >=1){

            //Redirecciona a la página de la vista con los resultados
            return view('user.showFollowers', ['followers' => $followers]);
        }else{
            //Realiza una redirección a la página principal
            return redirect()->route('mymainpage');
        }
    }

    //Recoge las cuentas seguidas de un usuario
    public function showFollowing($id){

        //Recoge los datos del usuario que llega por url
        $user = user::find($id);

        //Recoge los seguidores del usuario
        $following = $user->following;

        if(count($following) >=1){

            //Redirecciona a la página de la vista con los resultados
            return view('user.showFollowing', ['following' => $following]);
        }else{
            //Realiza una redirección a la página principal
            return redirect()->route('mymainpage');
        }
    }    
}