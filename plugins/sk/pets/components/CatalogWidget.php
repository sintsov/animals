<?php
namespace Sk\Pets\Components;

use Cms\Classes\ComponentBase;
use Redirect;
use BackendAuth;
use Sk\Pets\Models\Pet as Pets;

class CatalogWidget extends ComponentBase
{
    public $catalog_url;
    public $count;

    public function componentDetails()
    {
        return [
            'name'        => 'sk.pets::lang.pets.catalog_widget',
            'description' => 'sk.pets::lang.pets.catalog_widget_short_description'
        ];
    }

    public function defineProperties()
    {
        return [
            'catalog_url' => [
                'title'       => 'sk.pets::lang.pets.catalog_url',
                'description' => 'sk.pets::lang.pets.catalog_url',
                'default'     => '/',
                'type'        => 'string'
            ]
        ];
    }

    public function onRun()
    {
        $this->catalog_url = $this->getCatalogUrl();
        $this->count       = $this->getCatalogCounts();
    }

    private function getCatalogUrl()
    {
        return [
            'dog' => '/pets/catalog/?dog',
            'cat' => '/pets/catalog/?cat',
            'main'=> '/pets/catalog/'
        ];
    }

    private function getCatalogCounts()
    {
        $petsModel = new Pets();

        return $petsModel->getCatalogCount();
    }
}
