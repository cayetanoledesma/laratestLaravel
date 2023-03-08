<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\UserController;
use App\Http\middleware\CkeckAge;
use App\Http\Controllers\AlumnoController;
use App\Mail\Notification;
use Illuminate\support\Facades\Mail;




Route::resource('alumno', AlumnoController::class)->middleware('auth');

// Route::resource('alumno', AlumnoController::class)->only([
//     'index', 'show', 'update', 'destroy', 'store', 'edit'
// ]);

// se puede tambien hacer una ruta uno a uno o de todos juntos como la ruta anterior
// Route::get('/alumno',[AlumnoController::class,'index']);

// Route::get('/alumno/create', [AlumnoController::class, 'create']);



Route::get('/', function () {
    return view('welcome');
});

Route::view('/bienvenido', 'usuario', ['name'=>"Cayetano"]);

//datos de interes fuera de ejercicio
//php artisan key:generate  sirve para llevarte el fichero env a casa 


Route::get('/bienvenido/{nombre}', function(string $userName){
    return view('usuario', ['name'=> $userName]);
})->name("bienvenida");


//quiero una ruta lo que sea + bienvenido   ~/bienvenidos/NOMBRE/id
Route::get('/bienvenidoAlfonso/{id}', function(int $id){
    return redirect()->route('bienvenida', ['nombre'=> "Alfonso", 'id'=>$id]);
});


Route::get('/userc/{name}', [UserController::class, 'show']);
Route::get('/userc/{id}/editar', [UserController::class, 'edit'])->middleware('checkade');


Auth::routes(['register'=>true, 'reset'=>true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(
    ['middleware'=>'auth'], function (){
        Route::get('/', [AlumnoController::class, 'index'])->name('home');
    });

Route::get('/email', function(){
//return (new Notification("Alfonso"))->render();
$mensaje = new Notification("Alfonso");

$response = Mail::to("cayetano.ledesma@escuelaestech.es")->cc("cayetano.ledesma@escuelaestech.es")->bcc("jesus.martinez@escuelaestech.es")->send($mensaje);

dump($response);
});



