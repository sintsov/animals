<?php return [
    'plugin' => [
        'name' => 'Watermark',
        'description' => 'Adds a watermark image to you pictures',
        'settings' => 'Watermark settings',
        'settings_description' => 'Watermark image upload'
    ],
    'watermark' => [
        'image' => 'Image to be a watermark',
        'offsetX' => 'offset X',
        'offsetY' => 'offset Y',
        'quality' => 'quality',
        'transparency' => 'transparency'
    ],
    'comments' => [
        'allow' => 'only *.jpg, *.png и *.gif files',
        'offsetX' => 'Right offset',
        'offsetY' => 'Bottom offset',
        'quality' => 'Image quality(only for *.jpeg files)',
        'transparency' => 'Transparency (only for not *.png files)',
        'button' => [
            'text' => 'Clear files',
            'was_deleted' => 'Files was successfully deleted',
            'comment' => 'This button delete all files like storage/app/uploads/public/56c/b56/976/thumb_25_450x519_0_0_auto.jpg, but leave in peace original files. So, if you decide to change watermark, you don\'t need to upload all pictures again! Just change picture in plugin settings and press "Clear files" button.'
        ]
    ]
];