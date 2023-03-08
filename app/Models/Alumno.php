<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alumno extends Model
{
    use HasFactory;

    protected $table = "alumnos";

    //Propiedad filable, es decir, una propiedad rellenable
    //y la utilizamos para rellenar los campos de la tabla en las consultas SQL

    protected $fillable = ['nombre', 'apellido', 'email','edad', 'direccion', 'foto'];

    //Propidad Hidden, son para ocultar los campos de la tabla en las consultas SQL, por ejemplo la contraseña

    protected $hidden = ['id'];

    public function obtenerAlumnos(){
       // DB::table('alumnos')->all(); se puede poner asi para llamar a todos los alumnos pero sin embrago se hace como abajo que es mas corto

       return Alumno::all();


    }

    public function obtenerAlumnoPorId($id){
        return Alumno::find($id); //esto nos devolveria un alumno igual al parametro 

    }

}


//LOS MODELOS SON LOS QUE SE COMUNICAN CON LA BASE DE DATOS