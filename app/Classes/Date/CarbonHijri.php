<?php


namespace App\Classes\Date;

use Carbon\Carbon;
use App\Classes\Date\Ucal;

class CarbonHijri extends Carbon
{
    public static function toMiladiFromHijri($time, $tz = null)
    {
        $time = new static($time, $tz);
        return static::createFromTimestamp(
            (new Ucal())->mktime($time->hour, $time->minute, $time->second, $time->month, $time->day, $time->year)
        );
    }

    public static function toHijriFromMiladi($time, $format = 'Y-m-d')
    {
      $time = new static($time, null);
      return (new Ucal)->date($format, $time->timestamp);
    }

    public function hijriFormat($format)
    {
        return (new Ucal)->date($format, $this->timestamp);
    }

    public static function hijriParse($time, $tz = null)
    {
        $time = new static($time, $tz);
        return static::createFromTimestamp(
            (new Ucal())->mktime($time->hour, $time->minute, $time->second, $time->month, $time->day, $time->year)
        );
    }
}
