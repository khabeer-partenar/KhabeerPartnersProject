<?php

namespace Modules\Committe\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Committe\Entities\Committee;


class ParticiptDest extends Model
{
  protected $table = 'participt_dests';

  protected $fillable = ['committees_id' , 'participant_destination_name'];
}
