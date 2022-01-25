<?php

namespace App\Http\Resources;

use App\Models\Country;
use Illuminate\Http\Resources\Json\JsonResource;

class CountryDataResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        /**
         * @var $this Country
         */
        return [
            'name' => $this->name,
            'confirmed' => $this->statistic->confirmed ?? 0,
            'recovered' => $this->statistic->recovered ?? 0,
            'deaths' => $this->statistic->deaths ?? 0,
        ];
    }
}
