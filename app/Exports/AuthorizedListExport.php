<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Modules\Committee\Entities\AuthorizedName;

class AuthorizedListExport implements FromView, WithEvents
{
    /**
     * @return View
     */
    public function view(): View
    {
        $authorizedNames = AuthorizedName::search(\Request::all())->get();
        return view('committee::authorizedName._partials.authorized_table', compact('authorizedNames'));
    }

    /**
     * @return array
     */
    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $event->sheet->getDelegate()->setRightToLeft(true);
                $event->sheet->autoSize();
            },
        ];
    }
}




