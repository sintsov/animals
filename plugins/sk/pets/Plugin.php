<?php namespace Sk\Pets;

use System\Classes\PluginBase;

class Plugin extends PluginBase
{
    public function registerComponents()
    {
        return [
            'Sk\Pets\Components\CatalogWidget'      => 'catalogWidget',
            'Sk\Pets\Components\SearchWidget'       => 'searchwidget',
            'Sk\Pets\Components\PetFilterWidget'    => 'petfilterwidget',
            'Sk\Pets\Components\FourPetsWidget'     => 'fourpetswidget'
        ];
    }

    public function registerSettings()
    {
    }
}
