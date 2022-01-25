<?php

namespace App\Http\Resources;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Resources\Json\JsonResource;

class SummaryResource extends JsonResource
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
         * @var $this Collection
         */
        return [
            'confirmed' => $this->sum('confirmed'),
            'recovered' => $this->sum('recovered'),
            'deaths' => $this->sum('deaths'),
        ];
    }
}
