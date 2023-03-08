<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddEmailToAlumnos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('alumnos', function (Blueprint $table) {
            $table->string('email', 100)->nullable()->after('apellido'); // si queremos colocar email despues de apellido se pondria "->after('apellido')"
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('alumnos', function (Blueprint $table) {
            $table->dropColumn('email');
        });
    }
}
