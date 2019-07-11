<?php

namespace Modules\Committee\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Core\Traits\SharedModel;

class TreatmentUrgency extends Model
{
    use SharedModel;
    protected $table = 'treatment_urgency';
    protected $fillable = ['name', 'description'];
}
