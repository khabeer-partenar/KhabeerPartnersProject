<?php


namespace Modules\Committee\Entities;


use Illuminate\Database\Eloquent\Model;

class CommitteeView extends Model
{
    protected $table = 'committee_view';
    protected $fillable = ['committee_id','user_id'];
    public static function setCommitteeView(Committee $committee)
    {
        $viewed = $committee->view()->where('user_id',auth()->user()->id)->first();
        if ($viewed == null) {
            $committeeView =new CommitteeView(['committee_id' => $committee, 'user_id' => auth()->user()->id]);
            $committee->view()->save($committeeView);
        }
    }

}