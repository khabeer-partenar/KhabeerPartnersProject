<?php

namespace Modules\Users\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\UserBaseController;
use Illuminate\Support\Facades\Storage;
use Modules\Committee\Entities\CommitteeDocument;

class SupportController extends UserBaseController
{

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('users::support.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Upload attachments
     * @param Request $request
     * @return Response
     */
    public function uploadAttachments(Request $request)
    {
        $file = $request->file('file');
        $path = Storage::put('temp-support', $file);

        $attachment = CommitteeDocument::create([
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
    public function deleteAttachments(CommitteeDocument $attachment)
    {
        Storage::delete($attachment->path);
        $attachment->delete();
        return response()->json(['msg' => 'deleted'], 200);
    }
}
