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
        $img->text($text, 800, 750, function($font) {
            $font->file(public_path('assets/fonts/trado.ttf'));
            $font->size(self::getFontSize(auth()->user()->name));
            $font->color('#3E3E3E');
            $font->align('center');
            $font->valign('bottom');
            $font->angle(45);
        })->opacity(50);

        $path = storage_path('app/public/watermarks/');
        if (!file_exists($path)) {
            mkdir($path, 666, true);
        }

        $img->save($path . auth()->id() . '.png');
        return $img->dirname.'/'.$img->basename;
    }

    public static function getFontSize($string)
    {
        $wordsCount = count(explode(' ', $string, 3));
        switch ($wordsCount) {
            case 4:
                return 75;
            case 3:
                return 120;
            case 1:
            case 2:
                return 250;
        }
    }
}
