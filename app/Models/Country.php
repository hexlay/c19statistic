<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Spatie\Translatable\HasTranslations;

class Country extends Model
{
    use HasTranslations;

    public $translatable = [
        'name'
    ];

    protected $fillable = [
        'code',
        'name'
    ];

    public function statistic(): HasOne
    {
        return $this->hasOne(Statistic::class);
    }

}
