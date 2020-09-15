<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class address extends Model
{
    //Indica con que tabla trabaja el modelo
    protected $table = "addresses";

    //Relación de muchos a muchos
    public function users(){
        return $this->belongsToMany("App/User");
    }
}
