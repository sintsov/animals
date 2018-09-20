<?php namespace Sk\Stories\Models;

use Model;
use Db;

/**
 * Model
 */
class Story extends Model
{
    use \October\Rain\Database\Traits\Validation;
    
    /**
     * @var array Validation rules
     */
    public $rules = [
    ];

    /**
     * @var string The database table used by the model.
     */
    public $table = 'sk_stories_stories';

    protected $jsonable = [
        'picture',
    ];


    /**
     * Get count of stories by types
     * @return mixed
     */
    public function getFourStories()
    {
        $stories = Db::table($this->table)
            ->select('*')
            ->orderBy('id', 'created_at')
            ->limit(4)
            ->get();
        return $stories;
    }
}
