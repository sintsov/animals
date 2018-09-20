<?php namespace Sk\Pets\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateSkPetsPets2 extends Migration
{
    public function up()
    {
        Schema::table('sk_pets_pets', function($table)
        {
            $table->date('birthdate')->nullable()->unsigned(false)->default(null)->change();
        });
    }
    
    public function down()
    {
        Schema::table('sk_pets_pets', function($table)
        {
            $table->dateTime('birthdate')->nullable()->unsigned(false)->default(null)->change();
        });
    }
}
