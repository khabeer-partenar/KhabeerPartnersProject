<?php

namespace Modules\Committe\Entities;

use Illuminate\Database\Eloquent\Model;

use Modules\Committe\Entities\Committee;


class TreatImportance extends Model
{
    protected $table = 'treat_importances';

    protected $fillable = ['committees_id' , 'treat_importance_name'];
}
