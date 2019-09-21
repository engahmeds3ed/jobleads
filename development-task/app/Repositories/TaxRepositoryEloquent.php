<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\taxRepository;
use App\Entities\Tax;
use App\Validators\TaxValidator;

/**
 * Class TaxRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class TaxRepositoryEloquent extends BaseRepository implements TaxRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Tax::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return TaxValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
