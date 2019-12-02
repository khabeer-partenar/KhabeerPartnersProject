<?php


namespace Modules\Core\Entities;
use Illuminate\Database\Eloquent\Model;
use Modules\Committee\Entities\Committee;
use Modules\Core\Traits\SharedModel;
use Modules\Users\Entities\Employee;

class Status extends Model
{
    use SharedModel;
    protected $fillable = ['status_ar'];

    // Note : these statuses constansts is tied to statuses in a database table
    // so if you changed the table you must change it here or vice versa

    const WAITING_DELEGATES = 1; // بانتظار ترشيح المناديب
    const NOMINATIONS_COMPLETED = 2; // مكتمل الترشيح
    const NOMINATIONS_DONE = 3; // تم الترشيحح
    const NOMINATIONS_NOT_DONE = 4; // لم يتم الترشيح

    ////////////////////////////////////////




}