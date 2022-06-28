<?php

namespace App\Exports;

use App\Models\Order;
use App\Models\Place;
use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;

class UserExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return  User::all();
    }
}
