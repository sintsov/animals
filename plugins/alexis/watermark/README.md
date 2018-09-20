# Watermark plugin
Adds a watermarks to your pictures on fly

## Plugin usage

Upload a picture, you want to use is watermark in plugin settings. 

Fill other settings

update your models, where you attache images in this way:

```
    public $attachOne = [
        'image' => ['Alexis\Watermark\Models\Watermark']
    ];
```
instead of 

```
    public $attachOne = [
        'image' => ['System\Models\File']
    ];
```
or 

```
    public $attachMany = [
        'images' => ['Alexis\Watermark\Models\Watermark']
    ];
```

instead of 

```
    public $attachMany = [
        'images' => ['System\Models\File']
    ];
```

**Obligatorily press "Clear files" button** in plugin settings!

This button delete all files like `storage/app/uploads/public/56c/b56/976/thumb_25_450x519_0_0_auto.jpg`, but 
leave in peace original files. So, if you decide to change watermark, you don't need 
to upload all pictures again! Just change picture in plugin settings and
press **"Clear files" button.**
 
Images with watermarks will automatically created when you use 
`{{ item.image.thumb(480, 550, {mode: 'crop'}) }}` (different modes can be used)

Don't forget to clear cache to see the changes!