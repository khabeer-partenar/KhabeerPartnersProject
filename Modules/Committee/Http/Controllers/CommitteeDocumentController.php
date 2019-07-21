<?php

namespace Modules\Committee\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;
use Modules\Committee\Entities\Committee;
use Modules\Committee\Entities\CommitteeDocument;
use Modules\Committee\Http\Requests\DocumentUploadRequest;

class CommitteeDocumentController extends Controller
{
    public function upload(DocumentUploadRequest $request)
    {
        $file = $request->file('file');
        $path = Storage::put('temp-committees', $file);
        $document = CommitteeDocument::create([
            'path' => $path,
            'name' => $file->getClientOriginalName(),
            'user_id' => auth()->id(),
            'size' => $file->getSize(),
            'description' => $request->description,
        ]);
        return response()->json([
            'document' => $document,
            'delete_url' => route('committees.delete-document', $document)
        ], 201);
    }

    public function uploadForCommittee(DocumentUploadRequest $request, Committee $committee)
    {
        $file = $request->file('file');
        $path = Storage::put("committees/$committee->id", $file);
        $document = $committee->documents()->create([
            'path' => $path,
            'name' => $file->getClientOriginalName(),
            'user_id' => auth()->id(),
            'size' => $file->getSize(),
            'description' => $request->description,
        ]);
        return response()->json([
            'document' => $document,
            'delete_url' => route('committees.delete-document', $document)
        ], 201);
    }

    public function delete(CommitteeDocument $document)
    {
        Storage::delete($document->path);
        $document->delete();
        return response()->json(['msg' => 'deleted'], 200);
    }
}
