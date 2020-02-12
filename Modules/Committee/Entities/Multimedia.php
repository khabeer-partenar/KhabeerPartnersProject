<?php


namespace Modules\Committee\Entities;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Core\Traits\SharedModel;
use Modules\Users\Entities\User;

class Multimedia extends Model
{
    use SharedModel;

    protected $table = 'committee_multimedia';
    protected $fillable = ['text', 'meeting_id', 'user_id', 'committee_id'];

    public static function createMultimedia($texts, $committeeId, $meetingId = null)
    {
        if (isset($texts)) {
            foreach ($texts as $text) {
                if (!$text == null) {
                    self::query()->create(
                        [
                            'committee_id' => $committeeId
                            , 'meeting_id' => $meetingId
                            , 'user_id' => auth()->user()->id
                            , 'text' => $text
                        ]

                    );
                }
            }
        }
    }

    /**
     * Relations
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}