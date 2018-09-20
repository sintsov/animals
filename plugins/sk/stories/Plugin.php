<?php namespace Sk\Stories;

use System\Classes\PluginBase;

class Plugin extends PluginBase
{
    public function registerComponents()
    {
        return [
            'Sk\Stories\Components\FourStoriesWidget'     => 'fourstorieswidget'
        ];
    }

    public function registerSettings()
    {
    }
}
