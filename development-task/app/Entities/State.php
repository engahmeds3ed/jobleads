<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class State.
 *
 * @package namespace App\Entities;
 */
class State extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ["country_id", "name", "code", "taxes_amount", "taxes_amount_avg", "taxrates_avg"];

    public function Country()
    {
        return $this->belongsTo(Country::class);
    }

}
