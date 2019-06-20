<?php

namespace Modules\Committe\Entities;

use Illuminate\Database\Eloquent\Model;

use Modules\Committe\Entities\Committee;


class TreatSpeed extends Model
{
  protected $table = 'treat_speeds';

  protected $fillable = ['committees_id' , 'treat_speed_name'];
}
