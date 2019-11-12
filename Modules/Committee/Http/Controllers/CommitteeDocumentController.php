<?php

namespace Modules\Committee\Http\Controllers;

use App\Classes\PDF\WaterMarker;
use App\Classes\UserWatermark;
use App\Http\Controllers\UserBaseController;
use Illuminate\Support\Facades\Storage;
use Modules\Committee\Entities\Committee;
use Modules\Committee\Entities\CommitteeDocument;
use Modules\Committee\Http\Requests\DocumentUploadRequest;

class CommitteeDocumentController extends UserBaseController
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

    public function download(CommitteeDocument $document)
    {
        $watermarkPath = UserWatermark::getWatermarkImage();

        $waterMarker = new WaterMarker($document, $watermarkPath);

        $savedPath = $waterMarker->drawWaterMark();

        return response()->download($savedPath, $document->name);
    }
}
