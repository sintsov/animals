<?php
namespace Sk\Pets\Components;

use Cms\Classes\ComponentBase;
use Redirect;
use BackendAuth;
use Sk\Pets\Models\Pet as Pets;

class FourPetsWidget extends ComponentBase
{
    public $catalog_url;
    public $count;
    public $pets;

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
        $this->pets = $this->getFourPets();
    }

    private function getCatalogUrl()
    {
        return [
            'dog' => '/pets/catalog/?dog',
            'cat' => '/pets/catalog/?cat',
            'main'=> '/pets/catalog/'
        ];
    }

    /**
     * @return mixed
     */
    private function getFourPets()
    {
        $petsModel = new Pets();

        $pets = $petsModel->getFourPets();

        foreach($pets as $key => $pet)
        {
            $pets[$key]->description = strip_tags($pet->description);

            if(!empty($pet->picture) && $this->isJSON($pet->picture))
            {
                $pets[$key]->picture = json_decode($pet->picture, true);
            }
        }

        return $pets;
    }

    /**
     * @param $string
     * @return bool
     */
    private function isJSON($string)
    {
        return is_string($string) && is_array(json_decode($string, true)) && (json_last_error() == JSON_ERROR_NONE) ? true : false;
    }
}
