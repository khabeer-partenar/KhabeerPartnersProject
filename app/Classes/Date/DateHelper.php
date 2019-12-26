<?php
/**
 * Created by PhpStorm.
 * User: DELL
 * Date: 24/12/2019
 * Time: 09:18 ص
 */

namespace App\Classes\Date;


use Carbon\Carbon;

class DateHelper
{
    public static function getCurrentDate()
    {
        $currentDate       = Carbon::now();
        $currentHijriDate  = CarbonHijri::toHijriFromMiladi($currentDate->format('Y-m-d'), 'd F Y');
        $currentDate       = $currentHijriDate . ' هـ الموافق ' . date('d') . ' '. trans('months.en_' . $currentDate->format('F')) .' ' . date('Y') . ' م';
        return $currentDate;
    }
}