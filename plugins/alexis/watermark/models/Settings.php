<?php namespace Alexis\Watermark\Models;

use Model;

class Settings extends Model
{
    public $implement = ['System.Behaviors.SettingsModel'];

    public $settingsCode = 'alexis_watermark_settings';

    public $settingsFields = 'fields.yaml';

    protected $cache = [];

    public $attachOne = [
        'watermark' => ['System\Models\File']
    ];

}