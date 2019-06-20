<?php

namespace Modules\Committe\Entities;

use Illuminate\Database\Eloquent\Model;

use Modules\Committe\Entities\Committee;


class StudyDest extends Model
{
  protected $table = 'study_dests';

  protected $fillable = ['committees_id' ,'study_destination_name'];
}
