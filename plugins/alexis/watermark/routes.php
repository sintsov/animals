<?php
use Alexis\Watermark\Controllers\Clear;
Route::get('/clear_watermark', array(function(){
    $controller = new Clear;
    $controller->clearThumbs();
}));
