<?php namespace Sk\Pets\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateSkPetsPets extends Migration
{
    public function up()
    {
        Schema::table('sk_pets_pets', function($table)
        {
            $table->text('type')->nullable();
            $table->increments('id')->unsigned(false)->change();
            $table->text('gender')->nullable()->unsigned(false)->default(null)->change();
            $table->text('food')->nullable()->unsigned(false)->default(null)->change();
        });
    }
    
    public function down()
    {
        Schema::table('sk_pets_pets', function($table)
        {
            $table->dropColumn('type');
            $table->increments('id')->unsigned()->change();
            $table->boolean('gender')->nullable()->unsigned(false)->default(null)->change();
            $table->boolean('food')->nullable()->unsigned(false)->default(null)->change();
        });
    }
}
