<?php namespace Sk\Stories\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateSkStoriesStories extends Migration
{
    public function up()
    {
        Schema::create('sk_stories_stories', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('pet');
            $table->text('title');
            $table->text('body');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('sk_stories_stories');
    }
}
