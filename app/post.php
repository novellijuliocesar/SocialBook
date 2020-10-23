<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class post extends Model
{
    //Indica con que tabla trabaja el modelo
    protected $table = "posts";

    //Relación de uno a muchos
    public function comments(){
        return $this->hasMany("App\Comment")->orderBy('id', 'desc');
    }

    //Relación de uno a muchos
    public function likes(){
        return $this->hasMany("App\Like");
    }

    //Relación de muchos a uno
    public function user(){
        return $this->belongsTo("App\User", "user_id");
    }
}
