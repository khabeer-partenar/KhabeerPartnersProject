<?php

namespace Modules\Committee\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
use Modules\Core\Traits\SharedModel;

class CommitteeDocument extends Model
{
    use SharedModel, SoftDeletes;

    protected $fillable = ['name', 'path', 'size', 'description', 'user_id', 'committee_id'];
    protected $appends = ['full_path'];

    public function getFullPathAttribute()
    {
        return Storage::url($this->attributes['path']);
    }
}
