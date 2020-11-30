<?php
/**
 * @author Mamdouh Magdy <mamdouh95@mu.edu.sa>
 */
namespace App\Classes\PDF;

use Illuminate\Support\Facades\Storage;
use Modules\Committee\Entities\CommitteeDocument;

class WaterMarker
{
    private $watermarkPath;
    private $document;
    private $position = 'center';

    public function __construct(CommitteeDocument $document, $watermarkPath)
    {
        $this->document = $document;
        $this->watermarkPath = $watermarkPath;
    }

    public function drawWaterMark()
    {
        //Specify path to image. The image must have a 96 DPI resolution.
        $watermark = new PDFWatermark($this->watermarkPath);

        //Set the position
        $watermark->setPosition($this->position);

        //Place watermark behind original PDF content. Default behavior places it over the content.
        $watermark->setAsBackground();

        //Specify the path to the existing pdf, the path to the new pdf file, and the watermark object
        $tempPath = public_path('temp-downloads/');

        if (!file_exists($tempPath)) {
            mkdir($tempPath, 666, true);
        }

        $savedPath = $tempPath . md5($this->document->id + auth()->id()) . '.pdf';
        $watermarker = new PDFWatermarker(
            Storage::path($this->document->path),
            $savedPath,
            $watermark
        );
        //Set page range. Use 1-based index.
        $watermarker->setPageRange(1);

        //Save the new PDF to its specified location
        $watermarker->savePdf();

        return $savedPath;
    }

    /**
     * @param string $watermarkPath
     */
    public function setWatermarkPath(string $watermarkPath)
    {
        $this->watermarkPath = $watermarkPath;
    }

    /**
     * @param mixed $position
     */
    public function setPosition($position)
    {
        $this->position = $position;
    }
}
