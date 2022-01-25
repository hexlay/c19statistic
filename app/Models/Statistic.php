<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Statistic extends Model
{

    protected $fillable = [
        'country_id',
        'confirmed',
        'recovered',
        'deaths',
    ];

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

}
