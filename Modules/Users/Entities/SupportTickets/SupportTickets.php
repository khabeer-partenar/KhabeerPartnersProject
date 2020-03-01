<?php

namespace Modules\Users\Entities\SupportTickets;

use Illuminate\Database\Eloquent\Model;
use Modules\Core\Traits\SharedModel;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Core\Traits\Log;

class SupportTickets extends Model
{
    use SharedModel, Log, SoftDeletes;


    protected $fillable = [
        'type_id', 'description'
    ];


    public static function createFromRequest($request)
    {
        $request->merge([
            'type_id' => $request->support_type,
            'description' => $request->support_details,
        ]);

        $ticket = auth()->user()->supportTickets()->create($request->only('type_id', 'description'));
        SupportTicketDocuments::updateDocumentsTicket($ticket->id);
        return $ticket;
    }

    public function type()
    {
        return $this->belongsTo(SupportTicketCategories::class,'type_id');
    }
}
