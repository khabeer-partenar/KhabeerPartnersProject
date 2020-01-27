<?php

namespace App\Exports;

use Modules\Committee\Entities\AuthorizedName;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\FromCollection;

class AuthorizedListExport implements FromCollection
{

    /**
    * @return \Illuminate\Support\Collection
    */

    public function collection()
    {
        $lists = AuthorizedName::search(\Request::all())->get();
        // $lists->setRightToLeft(true);
        return $lists;
    }
}




