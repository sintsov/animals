<?php namespace Sk\Stories\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateSkStoriesStories extends Migration
{
    public function up()
    {
        Schema::table('sk_stories_stories', function($table)
        {
            $table->timestamp('deleted_at')->nullable();
        });
    }
    
    public function down()
    {
        Schema::table('sk_stories_stories', function($table)
        {
            $table->dropColumn('deleted_at');
        });
    }
}
