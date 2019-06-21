<?php

namespace Modules\Committe\Entities;

use Illuminate\Database\Eloquent\Model;

use Modules\Committe\Entities\Committee;


class Document extends Model
{
  protected $table = 'documents';

  protected $fillable = ['committees_id' , 'document_name'];
}
