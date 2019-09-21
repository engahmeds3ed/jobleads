<?php

namespace App\Services;

use App\Entities\County;
use App\Helpers\DataHelper;
use App\Repositories\CountyRepository;
use Illuminate\Support\Facades\Log;

class CountyService
{
    protected $states;

    public function __construct(CountyRepository $counties)
    {
        $this->counties = $counties;
    }

    public function all(array $params = [])
    {
        $perPage = $params['per_page'] ?? 10;
        $paginate = $params['paginate'] ?? true;

        $query = $this->counties;

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

    public function find(int $id):County
    {
        return $this->counties->find($id);
    }

    public function getCountyBy($field, $value){
        return $this->counties->findByField($field, $value);
    }

    public function getCountyByCode($code)
    {
        return $this->getCountyBy("code", $code);
    }

    /**
     * Create new County
     * @param array $attributes
     * @return County
     */
    public function create(array $attributes):County
    {
        $county = new County();

        $allowedAttr = $county->getFillable();
        $createArgs = DataHelper::filterArrayWithKeys($attributes, $allowedAttr);
        try {
            $county = $this->counties->create($createArgs);
        } catch (\Exception $e) {
            Log::error($e);
        }
        return $county;
    }

    /**
     * Update County
     * @param  array  $attributes
     * @return State
     */
    public function update(array $attributes, int $id):County
    {
        $county = $this->find($id);

        $allowedAttr = $county->getFillable();
        $updateArgs = DataHelper::filterArrayWithKeys($attributes, $allowedAttr);
        try {
            $county = $this->counties->update($updateArgs, $id);
        } catch (\Exception $e) {
            Log::error($e);
        }
        return $county;
    }

    public function delete(int $id):bool
    {
        $county = $this->find($id);
        return $this->counties->delete($county->id);
    }

}
