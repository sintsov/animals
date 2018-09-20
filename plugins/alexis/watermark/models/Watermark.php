<?php namespace Alexis\Watermark\Models;

use October\Rain\Database\Attach\File;
use Alexis\Watermark\Models\Settings;
use Model;
use Config;
use Request;


/**
 * Watermark Model
 */
class Watermark extends File
{
    /**
     * @var string The table associated with the model.
     */
    protected $table = 'system_files';

    /**
     * @var array
     */
    protected $settings;

    /**
     * Define the public address for the storage path.
     */
    public function getPublicPath() {
        $uploadsPath = Config::get('cms.storage.uploads.path', '/storage/app/uploads');

        if (!starts_with($uploadsPath, ['//', 'http://', 'https://'])) {
            $uploadsPath = Request::getBasePath() . $uploadsPath;
        }

        if ($this->isPublic()) {
            return $uploadsPath . '/public/';
        } else {
            return $uploadsPath . '/protected/';
        }
    }

    public function getThumb($width, $height, $options = []) {

        $this->settings = Settings::instance();
        $options = $this->getDefaultThumbOptions($options);
        $thumbFile = $this->getThumbFilename($width, $height, $options);
        if (!$this->hasFile($thumbFile)) {
            $watermarkFile = $this->getSetting('watermark');
            if (!$watermarkFile) {
                return parent::getThumb($width, $height, $options);
            }
            $watermarkFile = $watermarkFile->getLocalPath();
            $sourseImage = parent::getThumb($width, $height, $options);
            $sourseImagePath = base_path() . $sourseImage;
            $watermarkFileAttr = $this->getImageAttr($watermarkFile);
            $sourseImageAttr = $this->getImageAttr($sourseImagePath);

            switch ($watermarkFileAttr['mime']) {
                case 'image/gif':
                    $oWatermarkImage = @imagecreatefromgif($watermarkFile);
                    break;
                case 'image/jpeg':
                    $oWatermarkImage = @imagecreatefromjpeg($watermarkFile);
                    break;
                case 'image/png':
                    $oWatermarkImage = @imagecreatefrompng($watermarkFile);
                    break;
            }

            switch ($sourseImageAttr['mime']) {
                case 'image/gif':
                    $oImage = @imagecreatefromgif($sourseImagePath);
                    break;
                case 'image/jpeg':
                    $oImage = @imagecreatefromjpeg($sourseImagePath);
                    break;
                case 'image/png':
                    $oImage = @imagecreatefrompng($sourseImagePath);
                    break;
            }

            $watermark_width = $watermarkFileAttr[0];
            $watermark_height = $watermarkFileAttr[1];

            $destX = $sourseImageAttr[0] - $watermark_width - $this->getSetting('offsetX');
            $destY = $sourseImageAttr[1] - $watermark_height - $this->getSetting('offsetY');

            if ($sourseImageAttr['mime'] == 'image/png') {
                if (function_exists('imagesavealpha') && function_exists('imagecolorallocatealpha')) {
                    $bg = imagecolorallocatealpha($oImage, 255, 255, 255, 127);
                    imagefill($oImage, 0, 0, $bg);
                    imagealphablending($oImage, FALSE);
                    imagesavealpha($oImage, TRUE);
                }
            }

            if ($watermarkFileAttr['mime'] == 'image/png') {
                imagecopy($oImage, $oWatermarkImage, $destX, $destY, 0, 0, $watermark_width, $watermark_height);
            } else {
                imagecopymerge($oImage, $oWatermarkImage, $destX, $destY, 0, 0, $watermark_width, $watermark_height, $this->getSetting('transparency'));
            }

            switch ($sourseImageAttr['mime']) {
                case 'image/gif':
                    imagegif($oImage, $sourseImagePath);
                    break;
                case 'image/jpeg':
                    imagejpeg($oImage, $sourseImagePath, $this->getSetting('quality'));
                    break;
                case 'image/png':
                    imagepng($oImage, $sourseImagePath);
                    break;
            }
            imageDestroy($oImage);

            imageDestroy($oWatermarkImage);

            return $sourseImage;
        } else {
            return parent::getThumb($width, $height, $options);
        }
    }

    public function getImageAttr($file) {
        $imageAttr = getimagesize($file);
        return $imageAttr;
    }

    private function getSetting($field) {
        return $this->settings->{$field};
    }
}