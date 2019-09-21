<?php

namespace App\Services;

use App\Entities\State;
use App\Helpers\DataHelper;
use App\Repositories\StateRepository;
use Illuminate\Support\Facades\Log;

class StateService
{
    protected $states;

    public function __construct(StateRepository $states)
    {
        $this->states = $states;
    }

    public function all(array $params = [])
    {
        $perPage = $params['per_page'] ?? 10;
        $paginate = $params['paginate'] ?? true;

        $query = $this->states;

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

    public function find(int $id):State
    {
        return $this->states->find($id);
    }

    public function getStateBy($field, $value){
        return $this->states->findByField($field, $value);
    }

    public function getStateByCode($code)
    {
        return $this->getStateBy("code", $code);
    }

    /**
     * Create new State
     * @param array $attributes
     * @return State
     */
    public function create(array $attributes):State
    {
        $state = new State();

        $allowedAttr = $state->getFillable();
        $createArgs = DataHelper::filterArrayWithKeys($attributes, $allowedAttr);
        try {
            $state = $this->states->create($createArgs);
        } catch (\Exception $e) {
            Log::error($e);
        }
        return $state;
    }

    /**
     * Update State
     * @param  array  $attributes
     * @return State
     */
    public function update(array $attributes, int $id):State
    {
        $state = $this->find($id);

        $allowedAttr = $state->getFillable();
        $updateArgs = DataHelper::filterArrayWithKeys($attributes, $allowedAttr);
        try {
            $state = $this->states->update($updateArgs, $id);
        } catch (\Exception $e) {
            Log::error($e);
        }
        return $state;
    }

    public function delete(int $id):bool
    {
        $state = $this->find($id);
        return $this->states->delete($state->id);
    }

}
