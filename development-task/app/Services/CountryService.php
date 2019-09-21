<?php

namespace App\Services;

use App\Entities\Country;
use App\Helpers\DataHelper;
use App\Repositories\CountryRepository;
use Illuminate\Support\Facades\Log;

class CountryService
{
    protected $countries;

    public function __construct(CountryRepository $countries)
    {
        $this->countries = $countries;
    }

    public function all(array $params = [])
    {
        $perPage = $params['per_page'] ?? 10;
        $paginate = $params['paginate'] ?? true;

        $query = $this->countries;

        if($paginate == true) {
            $collection = $query->paginate($perPage);
        }else{
            $collection = $query->get();
        }

        return $collection;
    }

    public function namedIDvalues($params = []){
        $output = [];
        $params['paginate'] = false;
        $items = $this->all($params);
        foreach ($items as $item){
            $output[$item->id] = $item->name;
        }
        return $output;
    }

    public function find(int $id):Country
    {
        $country = $this->countries->find($id);
        return $country;
    }

    public function getCountryBy($field, $value){
        return $this->countries->findByField($field, $value);
    }

    public function getCountryByCode($code)
    {
        return $this->getCountryBy("code", $code);
    }

    /**
     * Create new Country
     * @param array $attributes
     * @return Country
     */
    public function create(array $attributes):Country
    {
        $country = new Country();

        $allowedAttr = $country->getFillable();
        $createArgs = DataHelper::filterArrayWithKeys($attributes, $allowedAttr);
        try {
            $country = $this->countries->create($createArgs);
        } catch (\Exception $e) {
            Log::error($e);
        }
        return $country;
    }

    /**
     * Update Country
     * @param  array  $attributes
     * @return Country
     */
    public function update(array $attributes, int $id):Country
    {
        $country = $this->find($id);

        $allowedAttr = $country->getFillable();
        $updateArgs = DataHelper::filterArrayWithKeys($attributes, $allowedAttr);
        try {
            $country = $this->countries->update($updateArgs, $country->id);
        } catch (\Exception $e) {
            Log::error($e);
        }
        return $country;
    }

    public function delete(int $id):bool
    {
        $country = $this->find($id);
        return $this->countries->delete($country->id);
    }

}
