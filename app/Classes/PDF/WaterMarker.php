<?php
/**
 * Created by PhpStorm.
 * User: DELL
 * Date: 10/11/19
 * Time: 01:01 م
 */

namespace App\Classes\PDF;

use Illuminate\Support\Facades\Storage;

class WaterMarker
{
    private $logo = 'assets/images/logo.png';
    private $pdf;
    private $position = 'bottomleft';

    public function __construct($pdf)
    {
        $this->pdf = $pdf;
    }

    public function updatePdf()
    {
        //Specify path to image. The image must have a 96 DPI resolution.
        $watermark = new PDFWatermark(public_path($this->logo));

        //Set the position
        $watermark->setPosition($this->position);

        //Place watermark behind original PDF content. Default behavior places it over the content.
        $watermark->setAsOverlay();

        //Specify the path to the existing pdf, the path to the new pdf file, and the watermark object
        $watermarker = new PDFWatermarker(
            Storage::path($this->pdf),
            Storage::path($this->pdf),
            $watermark
        );

        //Set page range. Use 1-based index.
        $watermarker->setPageRange(1);

        //Save the new PDF to its specified location
        $watermarker->savePdf();
    }

    /**
     * @param string $logo
     */
    public function setLogo(string $logo)
    {
        $this->logo = $logo;
    }

    /**
     * @param mixed $position
     */
    public function setPosition($position)
    {
        $this->position = $position;
    }
}