<?php namespace Sk\Pets\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateSkPetsPets extends Migration
{
    public function up()
    {
        Schema::create('sk_pets_pets', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->text('name')->nullable();
            $table->boolean('gender')->nullable();
            $table->text('breed')->nullable();
            $table->dateTime('birthdate')->nullable();
            $table->integer('height')->nullable();
            $table->boolean('food')->nullable();
            $table->text('place')->nullable();
            $table->date('arrival_date')->nullable();
            $table->date('departure_date')->nullable();
            $table->date('death_date')->nullable();
            $table->text('description')->nullable();
            $table->text('picture')->nullable();
            $table->text('video')->nullable();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('sk_pets_pets');
    }
}
