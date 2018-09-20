<?php namespace Sk\Pets\Models;

use October\Rain\Database\Model;
use Db;

/**
 * Model
 */
class Pet extends Model
{
    use \October\Rain\Database\Traits\Validation;
    
    /*
     * Disable timestamps by default.
     * Remove this line if timestamps are defined in the database table.
     */
    public $timestamps = false;

    /**
     * @var array Validation rules
     */
    public $rules = [

    ];

    protected $jsonable = [
        'picture',
    ];

    /**
     * @var string The database table used by the model.
     */
    public $table = 'sk_pets_pets';

    /**
     * Pet constructor.
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes = []);
    }

    /**
     * Get count of pets by types
     * @return mixed
     */
    public function getCatalogCount()
    {
        $count = Db::table($this->table)
            ->select(Db::raw('count(*) as pets_count, type'))
            ->groupBy('type')
            ->get()
            ->lists('pets_count', 'type');

        $all = 0;

        foreach($count as $row)
        {
            $all += (int)$row;
        }

        $count['all'] = $all;

        return $count;
    }

    /**
     * Get count of pets by types
     * @return mixed
     */
    public function getFourPets()
    {
        $pets = Db::table($this->table)
            ->select('*')
            ->orderBy('id', 'desc')
            ->limit(4)
            ->get();
        return $pets;
    }

    /**
     * @return mixed
     */
    public function getSearchBreedCriteria()
    {
        $breeds = Db::table($this->table)
            ->select(Db::raw('breed'))
            ->groupBy('breed')
            ->get()
            ->lists('breed');

        return $breeds;
    }
}
