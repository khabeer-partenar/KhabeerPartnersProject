<?php

namespace Modules\Users\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\UserBaseController;
use Modules\Users\Http\Requests\SupportDocumentUploadRequest;
use Illuminate\Support\Facades\Storage;
use Modules\Users\Entities\SupportTickets\SupportTickets;
use Modules\Users\Entities\SupportTickets\SupportTicketCategories;
use Modules\Users\Entities\SupportTickets\SupportTicketDocuments;
use Modules\Users\Notifications\newSupportTicketAdded;
use Notification;

class SupportController extends UserBaseController
{

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $categories = SupportTicketCategories::pluck('title', 'id');
        $documents = SupportTicketDocuments::where('user_id', auth()->id())->whereNull('ticket_id')->get();
        return view('users::support.create', compact('categories', 'documents'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $ticket = SupportTickets::createFromRequest($request);
        $ticket->log('create_support_tickets');
        session()->flash('alert-success', __('users::support.support_ticket_created'));
        Notification::route('mail', env('Mail_SUPPORT_email'))->notify(new newSupportTicketAdded($ticket, \Auth::user()));
        return redirect()->route('support.create');
    }

    /**
     * Upload attachments
     * @param Request $request
     * @return Response
     */
    public function uploadAttachments(SupportDocumentUploadRequest $request)
    {
        $file = $request->file('file');
        $path = Storage::put('temp-support', $file);

        $attachment = SupportTicketDocuments::create([
            'path' => $path,
            'name' => $file->getClientOriginalName(),
            'user_id' => auth()->id(),
            'size' => $file->getSize(),
            'description' => $request->description,
        ]);

        return response()->json([
            'attachment' => $attachment,
            'delete_url' => route('support.delete-attachments', $attachment)
        ], 201);
    }


    /**
     * delete attachment
     * @return Response
     */
    public function deleteAttachments(SupportTicketDocuments $attachment)
    {
        if($attachment->user_id != auth()->id()) {
            abort(404);
        }
        Storage::delete($attachment->path);
        $attachment->delete();
        return response()->json(['msg' => 'deleted'], 200);
    }
}
