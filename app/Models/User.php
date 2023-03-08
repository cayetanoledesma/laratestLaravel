<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use  HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */

     //Aqui se definen los campos para castearlos,por defecto castea los string, sin embargo, los bolean y datatime hay que declararlo 
    protected $casts = [
        'email_verified_at' => 'datetime',
        'activo'=>'boolean',
    ];


    public function getJWTIdentifier(){
        return $this->getKey();

    }

    public function getJWTCustomClaims(){
        return [];
    }

    // public function isSuperAdmin(){
    //     return $this->rol == 1
    //

    // public function isAdmin(){
    //     return $this->rol < 2
    // }


//Obtener todos los posts de un usuario, es decir, de (uno a muchos)
public function posts(){
    return $this->hasMany(Post::class);
    }

    public function phone(){
        //return $this->hasMany(Phone::class); //si quieres que un usuario tenga varios teléfonos
        return $this->hasOne(Phone::class);//Si solo quieres que un usuario tenga un telefono
    }
}

