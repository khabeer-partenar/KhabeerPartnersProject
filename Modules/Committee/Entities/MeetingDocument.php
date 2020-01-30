<?php

namespace Modules\Committee\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
use Modules\Core\Traits\SharedModel;

class MeetingDocument extends Model
{
    use SharedModel, SoftDeletes;

    protected $fillable = ['path', 'meeting_id', 'committee_id', 'name', 'size', 'description', 'user_id', 'owner'];
    protected $appends = ['full_path'];

    public function getFullPathAttribute()
    {
        return Storage::url($this->attributes['path']);
    }

    public static function updateDocumentsMeeting($meetingId, $committeeId)
    {
        $documents = self::where('user_id', auth()->id())->where('committee_id', $committeeId)->whereNull('meeting_id')->get();
        foreach ($documents as $document) {
            $fileName = basename($document->path);
            $newPath = "meetings/$meetingId/$fileName";
            $moved = Storage::move($document->path, $newPath);
            if ($moved) {
                $document->update(['meeting_id' => $meetingId, 'path' => $newPath]);
            }
        }
    }
}
