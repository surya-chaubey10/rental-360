<?php

namespace App\Classes;

use Spatie\Browsershot\Browsershot;

class HtmlToImage
{
    /**
     * generate
     * v.1.0.17 
     * @param  mixed $url
     * @return void
     */
    public static function generate($url)
    {
        return Browsershot::url($url)->save(
            storage_path('app/tmp/image.png')
        );
    }
}
