<?php

namespace App\Classes;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Johntaa\Arabic\I18N_Arabic;

class UserWatermark
{
    public static function getWatermarkImage()
    {
        $img = Image::make(public_path('assets/images/watermark.png'));
        $arabic = new I18N_Arabic('Glyphs');
        $text = $arabic->utf8Glyphs(auth()->user()->name);
        $img->text($text, 250, 80, function($font) {
            $font->file(public_path('assets/fonts/trado.ttf'));
            $font->size(30);
            $font->color('#999');
            $font->align('center');
            $font->valign('bottom');
            $font->angle(0);
        });
        $path = storage_path('app/public/watermarks/');
        if (!file_exists($path)) {
            mkdir($path, 666, true);
        }

        $img->save($path . auth()->id() . '.png');
        return $img->dirname.'/'.$img->basename;
    }
}