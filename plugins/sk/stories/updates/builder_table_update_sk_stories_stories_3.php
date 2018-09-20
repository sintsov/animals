<?php namespace Sk\Stories\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateSkStoriesStories3 extends Migration
{
    public function up()
    {
        Schema::table('sk_stories_stories', function($table)
        {
            $table->text('image')->nullable();
        });
    }
    
    public function down()
    {
        Schema::table('sk_stories_stories', function($table)
        {
            $table->dropColumn('image');
        });
    }
}
