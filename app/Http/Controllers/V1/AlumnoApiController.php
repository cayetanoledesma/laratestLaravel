<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Alumno;
use JWTAuth;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class AlumnoApiController extends Controller
{
//Lista todos los alumnos
    public function index(){
        return Alumno::get();

}

    public function show($id){
        //Buscar al alumno
        $alumno = Alumno::find($id);


        //Si el ealumno no existe, devolvemos un error

        if(!$alumno){
            return response()->json([
                'message'=> 'Alumno no encontrado'
            ], 404);
        }

        //Si hay alumno

        return $alumno;
    }

    public function store(Request $request){

        //validar  los datos

        $data = $request->only('nombre', 'apellido', 'email', 'edad', 'direccion', 'foto');

        $validator = Validator::make($data, [
            'nombre'=>'required|string|max:250',
            'apellido'=> 'required|string|max:250',
            'email'=>'required|email',
            'edad'=>'required|int|min:0|max:150',
            'direccion'=>'required|string|max:250',
            'foto'=>'required|max:20480000|mimes:jpg,png,jpg'
        ]);

        //SI FALLA LA VALIDACION

        IF($validator->fails()){
            return response()->json(['error'=> $validator->messages()], 400);

        }

        $alumno = Alumno::create([
            'nombre'=> $request->nombre,
            'apellido'=> $request->apellido,
            'email'=> $request->email,
            'edad'=> $request->edad,
            'direccion'=> $request->direccion,
            'foto'=>$request->file('foto')->store('uploads', 'public'),
        ]);

        return response()->json([
            'message'=> 'Alumno created',
            'data'=> $alumno
        ], Response::HTTP_OK);
    }

    public function update(request $request, $id){
        //validar datos
        $data = $request->only('nombre', 'apellido', 'email', 'edad', 'direccion', 'foto');
        $validator = Validator::make($data, [
            'nombre'=>'required|string|max:250',
            'apellido'=> 'required|string|max:250',
            'email'=>'required|email',
            'edad'=>'required|int|min:0|max:150',
            'direccion'=>'required|string|max:250',
            'foto'=>'max:20480000|mimes:jpg,png,jpg'


        ]);

        //si falla la validación
        if($validator->fails()){
            return response()->json(['error'=>$validator->messages()]. 400);
            
        }

        //Buscamos el alumno en base a la id

        $alumno = Alumno::findOrfail($id);

        //Actulaizamos el alumno

        // $datosAlumno = [
        //     'nombre'=> $request->nombre,
        //     'apellido'=> $request->apellido,
        //     'email'=> $request->email,
        //     'edad'=> $request->edad,
        //     'direccion'=> $request->direccion,
            
        // ];

        if ($request->hasFile('foto')){
            //si tiene una foto eliminamos la antigua y guardamos la nueva
            //$alumno = Alumno::findOrFail($id);
            Storage::delete('public/' . $alumno->foto);
                $data['foto'] = $request->file('foto')->store('uploads', 'public');
    }
    $alumno->update($data);

    //Devolvemos los datos actualizados
    return response()->json([
        'message'=> 'Alumno updates succefuly',
        'data'=> $alumno,
       
    ], Response::HTTP_OK);
}

public function destroy($id){

    //Buscamos al alumno

    $alumno = Alumno::findOrFail($id);


    if($alumno){

    //Eliminamos el alumno
    $alumno->delete();

    //Devolvemos respuesta

    return response()->json([
        'message'=> 'Alumno delete successfully'
    ], Response::HTTP_OK);
}else{
  return response()->json([
    'message'=> 'Alumno doesnt exixts'
  ], 401);

}
}

}