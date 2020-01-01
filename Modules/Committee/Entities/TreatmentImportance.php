<?php

namespace Modules\Committee\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Core\Traits\SharedModel;

class TreatmentImportance extends Model
{
    use SharedModel;
    protected $table = 'treatment_importance';
    protected $fillable = [];
    const SECRET = 2;
    const VERY_SECRET = 3;
}
