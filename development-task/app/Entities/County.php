<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class County.
 *
 * @package namespace App\Entities;
 */
class County extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ["state_id", "name", "code", "taxes_amount", "taxes_amount_avg", "taxrates_avg"];

    public function state()
    {
        return $this->belongsTo(State::class);
    }

}
