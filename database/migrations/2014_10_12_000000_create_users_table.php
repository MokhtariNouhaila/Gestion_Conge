<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\User;
class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nom');
            $table->string('prenom');
            $table->string('email');
            $table->integer('duree');
            $table->integer('autorise');
            $table->integer('credit')->default(0);
            $table->boolean('is_admin')->default(0);
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
        $user=new User();
        $user->nom="mokhtari";
        $user->prenom="nouhaila";
        $user->email="1@1";
        $user->password=Hash::make("1");
        $user->duree=30;
        $user->autorise=30;
        $user->is_admin=1;
          $user->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
