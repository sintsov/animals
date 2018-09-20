<?php namespace Alexis\Watermark\Controllers;

use BackendMenu;
use Backend\Classes\Controller;
use Storage;

/**
 * Clear Back-end Controller
 */
class Clear extends Controller
{
    public $implement = [
        'Backend.Behaviors.FormController',
        'Backend.Behaviors.ListController'
    ];

    public $formConfig = 'config_form.yaml';
    public $listConfig = 'config_list.yaml';

    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('Alexis.Watermark', 'watermark', 'settings');

    }

    /**
     * return void
     */
    public function clearThumbs() {
        $allFolders = array_reverse(Storage::allDirectories('uploads'));
        $deletedFiles = 0;
        foreach ($allFolders as $directory) {
            $files = Storage::allFiles($directory);
            foreach ($files as $file) {
                if (strripos($file, 'thumb_') !== FALSE) {
                    Storage::delete($file);
                    $deletedFiles++;
                }
            }
        }
    }
}
