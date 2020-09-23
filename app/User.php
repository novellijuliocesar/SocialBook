<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'role', 'name', 'surname', 'nickname', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    //Relación de muchos a muchos
    public function addresses(){
        return $this->belongsToMany("App\Address");
    }

    //Relación de uno a muchos
    public function posts(){
        return $this->hasMany("App\Post");
    }

    //Relación de uno a muchos
    public function likes(){
        return $this->hasMany("App\Like");
    }

    //Relación de uno a muchos
    public function comments(){
        return $this->hasMany("App\Comment");
    }

    //Relación de muchos a muchos
    public function followers()
    {
        return $this->belongsToMany(User::class, 'followers', 'user_id', 'follower_id');
    }

    //Relación de muchos a muchos
    public function following()
    {
        return $this->belongsToMany(User::class, 'followers', 'follower_id', 'user_id');
    }

}
