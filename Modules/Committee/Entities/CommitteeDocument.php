<?php

namespace Modules\Committee\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Modules\Core\Traits\SharedModel;

class CommitteeDocument extends Model
{
    use SharedModel;
    protected $fillable = ['name', 'path', 'size', 'description', 'user_id', 'committee_id'];
    protected $appends = ['full_path'];

    public function getFullPathAttribute()
    {
        return Storage::url($this->attributes['path']);
    }

    public static function updateDocumentsCommittee($committeeId)
    {
        $documents = self::where('user_id', auth()->id())->whereNull('committee_id')->get();
        foreach ($documents as $document) {
            $document->update(['committee_id' => $committeeId]);
        }
    }
}
