<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class like extends Model
{
    //Indica con que tabla trabaja el modelo
    protected $table = "likes";

    //Relación de muchos a uno
    public function user(){
        return $this->belongsTo("App\User", "user_id");
    }

    //Relación de muchos a uno
    public function posts(){
        return $this->belongsTo("App\Post", "post_id");
    }

    //Relación de muchos a uno
    public function comments(){
        return $this->belongsTo("App\Comment", "comment_id");
    }
}
