<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    // //Método invocable solo se utiliza cuando hay solo una funcion en el controlador 
    // public function __invoke(string $name){
    //     //return "Hola $name";      Se puede hacer tb así 
    //     return view('usuario', ['name'=> $name]);
    // }



public function show(Request $request, $id){
    $name = $request->name;
    return view('usuario', ['name'=> $name]);  //localhost:8001/userc/Cayetano?name=jose asi lo llamamos y lo que hace es que ponemos ?name=jose y nos muestra hola Jose
   

}

public function edit($id){
    return "editar";
}

public function index(){
    return "Listado de usuarisos";
}

}
