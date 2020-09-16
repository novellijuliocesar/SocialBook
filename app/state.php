<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class state extends Model
{
    //Indica con que tabla trabaja el modelo
    protected $table = "states";

    //Relación de uno a muchos
    public function posts(){
        return $this->hasMany("App\Post");
    }
}
