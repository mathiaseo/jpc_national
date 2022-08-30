<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJeunesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jeunes', function (Blueprint $table) {
            $table->id();
            $table->string('firstname', 400);
            $table->string('lastname', 400);
            $table->string('city', 400);
            $table->enum('fonction', ["Jeune","President","Secretaire","Vice-president","Tresorier","Animateur","Conseiller"]);
            $table->boolean('is_married');
            $table->boolean('is_water_baptism');
            $table->boolean('is_spirit_baptism');
            $table->date('birthday');
            $table->date('date_water_baptism');
            $table->date('date_spirit_baptism');
            $table->enum('sexe', ["Masculin","Feminin"]);
            $table->unsignedBigInteger('localite_id');
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
        Schema::dropIfExists('jeunes');
    }
}
