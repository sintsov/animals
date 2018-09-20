<?php namespace Alexis\Watermark;

use System\Classes\PluginBase;

class Plugin extends PluginBase
{

    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name'        => 'alexis.watermark::lang.plugin.name',
            'description' => 'alexis.watermark::lang.plugin.description',
            'author'      => 'Alexis',
            'icon'        => 'icon-image',
            'homepage'    => 'https://rusit.rs'
        ];
    }

    public function registerSettings()
    {
        return [
            'settings' => [
                'label'       => 'alexis.watermark::lang.plugin.settings',
                'description' => 'alexis.watermark::lang.plugin.settings_description',
                'category'    => 'Watermark',
                'icon'        => 'icon-image',
                'class'       => 'Alexis\Watermark\Models\Settings',
                'order'       => 500,
                'keywords'    => 'watermark image',
                'permissions' => ['alexis.watermark.access_settings']
            ]
        ];
    }
}
