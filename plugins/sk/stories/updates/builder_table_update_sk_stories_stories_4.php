<?php namespace Sk\Stories\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateSkStoriesStories4 extends Migration
{
    public function up()
    {
        Schema::table('sk_stories_stories', function($table)
        {
            $table->renameColumn('image', 'picture');
        });
    }
    
    public function down()
    {
        Schema::table('sk_stories_stories', function($table)
        {
            $table->renameColumn('picture', 'image');
        });
    }
}
