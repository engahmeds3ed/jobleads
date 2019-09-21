<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\TaxrateRepository;
use App\Entities\Taxrate;
use App\Validators\TaxrateValidator;

/**
 * Class TaxrateRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class TaxrateRepositoryEloquent extends BaseRepository implements TaxrateRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Taxrate::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return TaxrateValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
