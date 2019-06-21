<?php

namespace Modules\Committe\Entities;

use Illuminate\Database\Eloquent\Model;

use Modules\Committe\Entities\Committee;


class TreatType extends Model
{
  protected $table = 'treat_types';

  protected $fillable = ['committees_id' , 'treat_type_name'];
}
