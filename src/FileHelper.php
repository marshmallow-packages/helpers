<?php

namespace Marshmallow\HelperFunctions;

class FileHelper
{
    public function getImageMimeTypes()
    {
        return [
            'image/apng',
            'image/bmp',
            'image/gif',
            'image/x-icon',
            'image/jpeg',
            'image/png',
            'image/svg+xml',
            'image/tiff',
            'image/webp',
        ];
    }
}
