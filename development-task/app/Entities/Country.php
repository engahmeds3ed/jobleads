<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Country.
 *
 * @package namespace App\Entities;
 */
class Country extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ["name", "code", "taxes_amount", "taxes_amount_avg", "taxrates_avg"];

    public function states()
    {
        return $this->hasMany(State::class);
    }
}
