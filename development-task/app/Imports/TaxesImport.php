<?php

namespace App\Imports;

use App\Services\CountyService;
use App\Services\TaxrateService;
use App\Services\TaxService;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class TaxesImport implements ToModel, WithStartRow
{
    public function startRow(): int
    {
        return 2;
    }

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $taxrate = app(TaxrateService::class)->getTaxrateByCode($row[7]);
        if(!$taxrate->isEmpty()){
            $taxrate_id = $taxrate->first()->id;
        }else{
            //@Todo: create tax rate if not found on DB
            $taxrate_id = 0;
        }
        $county = app(CountyService::class)->getCountyByCode($row[1]);
        if(!$county->isEmpty()){
            $county_id = $county->first()->id;
        }else{
            //@Todo: create county if not found on DB
            $county_id = 0;
        }
        $amount = $row[9];

        $tax = [
            "taxrate_id" => $taxrate_id,
            "county_id" => $county_id,
            "amount" => $amount
        ];
        app(TaxService::class)->create($tax);
    }
}
