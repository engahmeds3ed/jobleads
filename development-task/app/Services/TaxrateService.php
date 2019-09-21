<?php

namespace App\Services;

use App\Entities\Taxrate;
use App\Helpers\DataHelper;
use App\Repositories\TaxrateRepository;
use Illuminate\Support\Facades\Log;

class TaxrateService
{
    protected $taxrates;

    public function __construct(TaxrateRepository $taxrates)
    {
        $this->taxrates = $taxrates;
    }

    public function all(array $params = [])
    {
        $perPage = $params['per_page'] ?? 10;
        $paginate = $params['paginate'] ?? true;

        $query = $this->taxrates;

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

    public function find(int $id):Taxrate
    {
        return $this->taxrates->find($id);
    }

    public function getTaxrateBy($field, $value){
        return $this->taxrates->findByField($field, $value);
    }

    public function getTaxrateByCode($code)
    {
        return $this->getTaxrateBy("code", $code);
    }

    /**
     * Create new Taxrate
     * @param array $attributes
     * @return Taxrate
     */
    public function create(array $attributes):Taxrate
    {
        $taxrate = new Taxrate();

        $allowedAttr = $taxrate->getFillable();
        $createArgs = DataHelper::filterArrayWithKeys($attributes, $allowedAttr);
        try {
            $taxrate = $this->taxrates->create($createArgs);
        } catch (\Exception $e) {
            Log::error($e);
        }
        return $taxrate;
    }

    /**
     * Update Taxrate
     * @param  array  $attributes
     * @return Taxrate
     */
    public function update(array $attributes, int $id):Taxrate
    {
        $taxrate = $this->find($id);

        $allowedAttr = $taxrate->getFillable();
        $updateArgs = DataHelper::filterArrayWithKeys($attributes, $allowedAttr);
        try {
            $taxrate = $this->taxrates->update($updateArgs, $taxrate->id);
        } catch (\Exception $e) {
            Log::error($e);
        }
        return $taxrate;
    }

    public function delete(int $id):bool
    {
        $taxrate = $this->find($id);
        return $this->taxrates->delete($taxrate->id);
    }

}
