<?php

namespace Modules\Users\Entities\SupportTickets;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
use Modules\Core\Traits\SharedModel;


class SupportTicketDocuments extends Model
{
    use SharedModel, SoftDeletes;

    protected $fillable = ['name', 'path', 'size', 'description', 'user_id', 'ticket_id'];
    protected $appends = ['full_path'];

    public function getFullPathAttribute()
    {
        return Storage::url($this->attributes['path']);
    }

    public static function updateDocumentsTicket($ticketId)
    {
        $documents = self::where('user_id', auth()->id())->whereNull('ticket_id')->get();

        foreach ($documents as $document) {

            $fileName = basename($document->path);
            $newPath  = "support_tickets/$ticketId/$fileName";
            $moved    = Storage::move($document->path, $newPath);

            if ($moved) {
                $document->update(['ticket_id' => $ticketId, 'path' => $newPath]);
            }

        }
    }
}
