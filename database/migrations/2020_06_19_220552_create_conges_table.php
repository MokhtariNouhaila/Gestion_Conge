<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCongesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */


    public function up()
    {  Schema::disableForeignKeyConstraints();
        Schema::create('conges', function (Blueprint $table) {
            $table->Increments('id');
            $table->timestamp('debut')->nullable();
            $table->timestamp('fin')->nullable();
            $table->integer('duree')->default(0);
            $table->integer('etat')->default(5);
          
            $table->timestamps(); 
          
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('conges');
    }
}
