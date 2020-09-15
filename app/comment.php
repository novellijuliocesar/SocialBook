<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class comment extends Model
{
    //Indica con que tabla trabaja el modelo
    protected $table = "comments";

    //Relación de muchos a uno
    public function users(){
        return $this->belongsTo("App/User", "user_id");
    }

    //Relación de muchos a uno
    public function posts(){
        return $this->belongsTo("App/Post", "post_id");
    }

    //Relación de uno a muchos
    public function likes(){
        return $this->hasMany("App/Like");
    }
}
