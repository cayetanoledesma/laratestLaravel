<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        "user_id", "title", "content"
    ];

    //Obtener el usuario al que pertenece(uno a uno) este post, es decir, un post solo puede tener un usuario

    public function user(){
        return $this->belongsTo(User::class);   
    }
}


