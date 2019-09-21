<?php

use App\Services\CountryService;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

class CountriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(CountryService $countryService)
    {
        $countries = [
            [
                "name" => "Egypt",
                "code" => "EG"
            ],
            [
                "name" => "Romania",
                "code" => "RO"
            ],
            [
                "name" => "Germany",
                "code" => "DE"
            ],
        ];
        foreach ($countries as $country)
        {
            if( $countryService->getCountryByCode($country['code'])->isEmpty() ){
                $countryService->create($country);
            }
        }
    }
}
