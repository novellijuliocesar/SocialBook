<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    //Indica con que tabla trabaja el modelo
    protected $table = "categories";

    //Relación de uno a muchos
    public function posts(){
        return $this->hasMany("App/Post");
    }
}
