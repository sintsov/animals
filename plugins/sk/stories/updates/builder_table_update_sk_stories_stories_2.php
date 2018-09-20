<?php namespace Sk\Stories\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateSkStoriesStories2 extends Migration
{
    public function up()
    {
        Schema::table('sk_stories_stories', function($table)
        {
            $table->integer('pet')->nullable()->change();
            $table->dropColumn('deleted_at');
        });
    }
    
    public function down()
    {
        Schema::table('sk_stories_stories', function($table)
        {
            $table->integer('pet')->nullable(false)->change();
            $table->timestamp('deleted_at')->nullable();
        });
    }
}
