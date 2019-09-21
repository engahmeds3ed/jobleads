<?php

namespace App\Exports;

use App\Services\TaxService;
use Maatwebsite\Excel\Concerns\FromCollection;

class TaxesExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return app(TaxService::class)->prepareDataForExport();
    }
}
