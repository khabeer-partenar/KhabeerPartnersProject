<?php

namespace Modules\Committe\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Committe\Entities\CommittePresident;
use Modules\Committe\Entities\Document;
use Modules\Committe\Entities\ParticiptDest;
use Modules\Committe\Entities\RecommendDest;
use Modules\Committe\Entities\StudyDest;
use Modules\Committe\Entities\TreatDest;
use Modules\Committe\Entities\TreatImportance;
use Modules\Committe\Entities\TreatSpeed;
use Modules\Committe\Entities\TreatType;


class Committee extends Model
{
  protected $table = 'committees';

    protected $fillable = ['treat_num' , 'treat_date', 'outgoing_number' , '	outgoing_date' ,
      'recommend_number' , 'recommend_date' , 'committee_subject' , 'committee_start_date' ,  '	committee_tasks' ,
     'members_number' , 'participant_standards' ,'doc_description'];

    public function treatDests ()
    {
      return $this->hasOne(TreatDest::class, 'committees_id', 'id');
    }
}
