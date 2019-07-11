<?php

namespace Modules\Committee\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Core\Traits\SharedModel;

class CommitteeDocument extends Model
{
    use SharedModel;
    protected $fillable = ['name', 'path', 'size', 'description'];
}
