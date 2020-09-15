<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class post extends Model
{
    //Indica con que tabla trabaja el modelo
    protected $table = "posts";

    //Relación de uno a muchos
    public function comments(){
        return $this->hasMany("App/Comment");
    }

    //Relación de uno a muchos
    public function likes(){
        return $this->hasMany("App/Like");
    }

    //Relación de muchos a uno
    public function users(){
        return $this->belongsTo("App/User", "user_id");
    }

    //Relación de muchos a uno
    public function Categories(){
        return $this->belongsTo("App/Category", "category_id");
    }

    //Relación de muchos a uno
    public function states(){
        return $this->belongsTo("App/State", "state_id");
    }
}
