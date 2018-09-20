<?php
namespace Sk\Pets\Components;

use Cms\Classes\ComponentBase;
use Redirect;
use BackendAuth;
use Sk\Pets\Models\Pet as Pets;

class SearchWidget extends ComponentBase
{
    public $search_url;
    public $criteria;
    public $actual_parameters;
    public $filter;

    public function componentDetails()
    {
        return [
            'name'        => 'sk.pets::lang.pets.search_widget',
            'description' => ''
        ];
    }

    public function defineProperties()
    {
        return [
            'search_url' => [
                'title'       => 'sk.pets::lang.pets.search_url',
                'description' => 'sk.pets::lang.pets.search_url',
                'default'     => '/',
                'type'        => 'string'
            ]
        ];
    }

    public function onRun()
    {
        $this->search_url           = $this->getSearchUrl();
        $this->criteria             = $this->getSearchCriteria();
        $this->actual_parameters    = $this->getActualParameters();

        $parameters = \Input::all();

        $this->filter = null;
        if(!empty($parameters['filter']))
        {
            $this->filter = $parameters['filter'];
        }
    }

    public function getActualParameters()
    {
        return \Input::all();
    }

    private function getSearchUrl()
    {
        return '/pets/catalog/search/';
    }

    /**
     * Prepared search criteria
     */
    private function getSearchCriteria()
    {
        $criteria = [
            'place' => ['Primorksiy Area', 'Nevskiy Area'],
            'type'  => ['Dog', 'Cat'],
            'gender'=> ['Male', 'Female'],
            'age'   => [
                1 => "0-1",
                3 => "1-3",
                5 => "3-5",
                999 => "5+"
            ],
            'breed' => [],
        ];

        $petsModel = new Pets();

        $criteria['breed'] = $petsModel->getSearchBreedCriteria();

        return $criteria;
    }
}
