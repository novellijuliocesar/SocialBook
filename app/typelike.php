<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class typelike extends Model
{
    //Indica con que tabla trabaja el modelo
    protected $table = "typelikes";

    //Relación de uno a muchos
    public function likes(){
        return $this->hasMany("App\Like");
    }
}
