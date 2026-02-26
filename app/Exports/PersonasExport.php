<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;

class PersonasExport implements FromCollection
{
    protected $records;

    public function __construct($records)
    {
        $this->records = $records;
    }

    public function collection(): Collection
    {
        return collect($this->records);
    }
}
