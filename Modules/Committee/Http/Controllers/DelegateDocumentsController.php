<?php

namespace Modules\Committee\Http\Controllers;

use App\Http\Controllers\UserBaseController;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Modules\Committee\Entities\Committee;
use Modules\Committee\Entities\Meeting;
use Modules\Committee\Entities\MeetingDocument;
use Modules\Committee\Http\Requests\DocumentUploadRequest;

class DelegateDocumentsController extends UserBaseController
{
    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(DocumentUploadRequest $request, Committee $committee, Meeting $meeting)
    {
        $file = $request->file('file');
        $path = Storage::put("meetings/$meeting->id", $file);
        $delegateDocument = MeetingDocument::create([
            'path' => $path,
            'name' => $file->getClientOriginalName(),
            'user_id' => auth()->id(),
            'size' => $file->getSize(),
            'description' => $request->description,
            'committee_id' => $committee->id
        ]);
        return response()->json([
            'delegateDocument' => $delegateDocument,
            'delete_url' => route('committee.meeting-document.delete-delegate', compact('committee', 'delegateDocument'))
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy(Committee $committee, MeetingDocument $document)
    {
        // TODO Check on Document
        Storage::delete($document->path);
        $document->delete();
        return response()->json(['msg' => 'deleted'], 200);
    }
}
