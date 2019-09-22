<?php

namespace App\Services;

use App\Entities\Tax;
use App\Helpers\DataHelper;
use App\Repositories\TaxRepository;
use Illuminate\Support\Facades\Log;

class TaxService
{
    protected $taxes;

    public function __construct(TaxRepository $taxes)
    {
        $this->taxes = $taxes;
    }

    public function all(array $params = [])
    {
        $perPage = $params['per_page'] ?? 10;
        $paginate = $params['paginate'] ?? true;

        $query = $this->taxes;

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

    public function find(int $id):Tax
    {
        return $this->taxes->find($id);
    }

    public function getTaxBy($field, $value){
        return $this->taxes->findByField($field, $value);
    }

    /**
     * Create new Tax
     * @param array $attributes
     * @return Tax
     */
    public function create(array $attributes):Tax
    {
        $tax = new Tax();

        $allowedAttr = $tax->getFillable();
        $createArgs = DataHelper::filterArrayWithKeys($attributes, $allowedAttr);
        try {
            $tax = $this->taxes->create($createArgs);
        } catch (\Exception $e) {
            Log::error($e);
        }
        return $tax;
    }

    /**
     * Update Tax
     * @param  array  $attributes
     * @return Tax
     */
    public function update(array $attributes, int $id):Tax
    {
        $tax = $this->find($id);

        $allowedAttr = $tax->getFillable();
        $updateArgs = DataHelper::filterArrayWithKeys($attributes, $allowedAttr);
        try {
            $tax = $this->taxes->update($updateArgs, $id);
        } catch (\Exception $e) {
            Log::error($e);
        }
        return $tax;
    }

    public function delete(int $id):bool
    {
        $tax = $this->find($id);
        return $this->taxes->delete($tax->id);
    }

    public function prepareDataForExport()
    {
        $output = collect([]);
        $output->push( collect(
            [
                "County Name",
                "County Code",
                "State Name",
                "State Code",
                "Country Name",
                "Country Code",
                "Tax Rate",
                "Tax Rate Code",
                "Tax Rate Percentage",
                "Tax Amount"
            ]
        ) );
        $taxes = $this->all(['paginate' => false]);
        if(!empty($taxes)){
            foreach ($taxes as $tax)
            {
                $thisTax = collect([
                    $tax->county->name,
                    $tax->county->code,
                    $tax->county->state->name,
                    $tax->county->state->code,
                    $tax->county->state->country->name,
                    $tax->county->state->country->code,
                    $tax->taxrate->name,
                    $tax->taxrate->code,
                    $tax->taxrate->amount,
                    $tax->amount
                    ]);
                $output->push($thisTax);
            }
        }
        return $output;
    }

}
