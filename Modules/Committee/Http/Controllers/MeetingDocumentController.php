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

class MeetingDocumentController extends UserBaseController
{
    /**
     * Store a newly created resource in storage.
     * @param Request|DocumentUploadRequest $request
     * @param Committee $committee
     * @return Response
     */
    public function store(DocumentUploadRequest $request, Committee $committee)
    {
        $file = $request->file('file');
        $path = Storage::put('temp-meetings', $file);
        $document = MeetingDocument::create([
            'path' => $path,
            'name' => $file->getClientOriginalName(),
            'user_id' => auth()->id(),
            'size' => $file->getSize(),
            'description' => $request->description,
            'committee_id' => $committee->id,
            'owner' => 1,
        ]);
        return response()->json([
            'document' => $document,
            'delete_url' => route('committee.meeting-document.delete', compact('committee', 'document'))
        ], 201);
    }

    /**
     * Update For meeting
     * @param DocumentUploadRequest $request
     * @param Committee $committee
     * @param Meeting $meeting
     * @return \Illuminate\Http\JsonResponse
     */
    public function storeForMeeting(DocumentUploadRequest $request, Committee $committee, Meeting $meeting)
    {
        $file = $request->file('file');
        $path = Storage::put("meetings/$meeting->id", $file);
        $document = MeetingDocument::create([
            'path' => $path,
            'name' => $file->getClientOriginalName(),
            'user_id' => auth()->id(),
            'size' => $file->getSize(),
            'description' => $request->description,
            'meeting_id' => $meeting->id,
            'committee_id' => $committee->id,
            'owner' => 1,
        ]);
        return response()->json([
            'document' => $document,
            'delete_url' => route('committee.meeting-document.delete', compact('committee', 'document'))
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     * @param Committee $committee
     * @param MeetingDocument $document
     * @return Response
     * @internal param int $id
     */
    public function destroy(Committee $committee, MeetingDocument $document)
    {
        Storage::delete($document->path);
        $document->delete();
        return response()->json(['msg' => 'deleted'], 200);
    }
}
