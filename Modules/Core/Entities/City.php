<?php


namespace Modules\Core\Entities;
use Illuminate\Database\Eloquent\Model;
use Modules\Core\Traits\SharedModel;

class City extends Model
{
    use SharedModel;


    protected $fillable = [
        'name'
    ];
}