<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alumno;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;



class AlumnoController extends Controller
{
    
    /*
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function index()
   {

       $datos['alumnos'] = Alumno::paginate(2);

       //tambien se puede hacer con SQL como indicamos abajo
       // $edad = 18;
        //$datos['alumnos'] = DB::select('select * from alumnos where edad > ?', [$edad]);
       return view('alumno.index', $datos);
   }

   /*
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function create()
   {
       return view('alumno.create');
   }

   /*
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
   public function store(Request $request)
   {
   //return dd($request->all());
      
    
      $datosAlumno = $request->except('_token');

        //con este condicional le decimos que si encuentra en request algun fichero(file) que se llame foto 
        //que guarde la imagen en store/app/public/uploads
        //y que guarde el nombre de la imagen en la base de datos

        if($request->hasFile('foto')){
        $datosAlumno['foto'] = $request->file('foto')->store('uploads', 'public');
        }
        Alumno::insert($datosAlumno);

        //tambien se puede hacer el insert de esta manera en SQL 
        // DB::insert('insert into alumnos(nombre, apellido, edad, email, direccion, foto) values (?,?,?,?,?,?', 
        // [$datosAlumno['nombre'],
        // $datosAlumno['apellido'],
        // $datosAlumno['edad'],
        // $datosAlumno['email'],
        // 'San joaquin,12',
        // $datosAlumno['foto']]);

      return redirect('alumno')->with('mensaje', 'Se ha creado el alumno: ' . $datosAlumno['nombre']);
   }

   /*
    * Display the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
   public function show($id)
   {
       $alumno = Alumno::findOrFail($id);

       return view('alumno.show', compact('alumno'));
   }

   /*
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
   public function edit($id)
   {
        $alumno = Alumno::findOrFail($id);
      return view('alumno.edit', compact('alumno'));
       //return redirect('alumno')->with('mensaje', 'se han modificado los datos' . $datosAlumno['nombre'] );
   }

   /*
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
   public function update(Request $request, $id)
   {
       $datosAlumno = request()->except('_token', '_method');
       //dd($datosAlumno);

       if ($request->hasFile('foto')){
        //si tiene una foto eliminamos la antigua y guardamos la nueva
        $alumno = Alumno::findOrFail($id);
        Storage::delete('public/' . $alumno->foto);
            $datosAlumno['foto'] = $request->file('foto')->store('uploads', 'public');

       }

       Alumno::where('id', '=', $id)->update($datosAlumno);

       //lo vamos a hacer con codigo SQL 
    //    $affected = DB::update('update alumnos setdireccion = "San Joaquin, 12" where id < ?', [10]); 
    //    echo "se ha modificado $affected alumnos";
    //    dd($affected);

       $alumno = Alumno::findOrFail($id);

      // return view('alumno.edit', compact('alumno'));
       return redirect('alumno')->with('mensaje', 'se ham modificado los datos del alumno' . $datosAlumno['nombre']);
   }

   /*
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
   public function destroy($id)
   {
    //esta funcion a partir de una id devuelve un objeto y si no lo encuentra devuelve un error pero no nulo
       $alumno = Alumno::findOrFail($id);

       if(Storage::delete('public/' . $alumno->foto)){
           Alumno::destroy($id);

           //tambien se puede utilizar en SQL
           //$deleted = DB::delete('delete from alumno where id= ?', [$id]);
           
       }
       

       return redirect('alumno')->with('mensaje', 'Se ha eliminado el alumno #' . $id);
   }


}

//Consultas generales que no devuelven nada

// DB::statement('drop table alumnos');




// Consultas no preparadas

// DB::unprepared('update alumnos set edad = 120 where id > 10');


//Transacciones : esta se utiliza cuando hay una serie de consultas y una de ellas falla,  no se llega a ejecutar
//por ejemplo, tenemos una funcion de pasar dinero de un usuario a otro, si falla alguna sentencia la transaccion entera se elimina y no llega a ejecutarse
//esta funcion se deberia de utilizar dentro cualquier funcion: index. destroy, update, .... el numero 5 son las veces que intenta de nuevo el programa a que funcione 
//la transaccion

// DB::transaction(function(){
//     DB::update('update alumnos set edad = 33');
//     DB::delete('delete from posts');

// }, 5);



//hay otra forma de ejecutar transacciones pero menos usada

// DB::beginTransaction();

// DB::roolBack();

// DB::commit();


