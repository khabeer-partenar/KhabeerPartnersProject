<?php

namespace Modules\Users\Entities\SupportTickets;

use Illuminate\Database\Eloquent\Model;
use Modules\Core\Traits\SharedModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class SupportTicketCategories extends Model
{
    use SharedModel, SoftDeletes;
    
    protected $fillable = [
        'name'
    ];
}
