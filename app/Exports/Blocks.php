<?php

namespace App\Exports;

use App\Models\Block;
use Maatwebsite\Excel\Concerns\FromCollection;

class Blocks implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Block::all();
    }
}
