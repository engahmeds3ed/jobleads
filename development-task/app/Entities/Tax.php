<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Tax.
 *
 * @package namespace App\Entities;
 */
class Tax extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ["taxrate_id", "county_id", "amount"];

    public function county()
    {
        return $this->belongsTo(County::class);
    }

    public function taxrate()
    {
        return $this->belongsTo(Taxrate::class);
    }

}
