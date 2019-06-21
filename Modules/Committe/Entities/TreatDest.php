<?php

namespace Modules\Committe\Entities;

use Illuminate\Database\Eloquent\Model;

use Modules\Committe\Entities\Committee;


class TreatDest extends Model
{
  protected $table = 'treat_dests';

  protected $fillable = ['committees_id' , 'treat_destination_name'];

  public function committees ()
  {
    return $this->belongsTo('Committee::class');
  }
}
