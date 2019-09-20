<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository as PrettusBaseRepository;

/**
 * Class AdvisorRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
abstract class BaseRepository extends PrettusBaseRepository
{
    public function filter(array $params)
    {
        $firstValidKey = false;
        foreach ($params as $filter) {
            if($filter['value'] === 'NULL') {
                if($filter['operator'] === '=') {
                    $this->model = $this->model->whereNull($filter['field']);
                }else{
                    $this->model = $this->model->whereNotNull($filter['field']);
                }
            }else{
                if(strtoupper($filter['operator']) == 'LIKE'){
                    $filter['value'] = "%".$filter['value']."%";
                }
                $this->model = $this->model->where($filter['field'], $filter['operator'], $filter['value']);
            }
        }
        return $this;
    }

    public function sort(string $sortBy, string $sort)
    {
        $this->model = $this->model->orderBy($sortBy, $sort);
        return $this;
    }
}
