<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUseridToAlumnos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::table('alumnos', function (Blueprint $table) {
        //     $table->unsignedBigInteger('userid')->after('id');    //definimos userid

        //     // EN EL CASO QUE QUERAMOS ASEGURARNOS QUE EXISTE LA TABLA PODEMOS USAR CODIGO
        //     if(Schema::hasTable('alumnos')){
        //         if(Schema::hasColumn('alumnos', 'userid')){
        //             if(Schema::hasColumn('users', 'id')){
        //                 $table->foreign('userid')->references('id')->on('users')->onDelete('cascade'); 
        //             }
        //         }
        //     }
        //         //le añadimos la clave foraneacon referencia id a usuarios y en cascada es que elimine uno y el otro en cascada
        //        //Para modificar una columna de la base de datos
          
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::table('alumnos', function (Blueprint $table) {
        //     $table->dropForeign('alumnos_userid_foreign');
        //     $table->dropColumn('userid');
        // });
    }
}
