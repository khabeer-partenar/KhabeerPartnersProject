<?php

namespace Modules\Committe\Entities;

use Illuminate\Database\Eloquent\Model;

use Modules\Committe\Entities\Committee;


class RecommendDest extends Model
{
  protected $table = 'recommend_dests';

  protected $fillable = [ 'committees_id' , 'recommend_destination_name'];
}
