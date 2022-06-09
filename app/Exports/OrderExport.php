<?php

namespace App\Exports;

use App\Models\Order;
use App\Models\Place;
use Maatwebsite\Excel\Concerns\FromCollection;

class OrderExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return  Place::all();
    }
}
