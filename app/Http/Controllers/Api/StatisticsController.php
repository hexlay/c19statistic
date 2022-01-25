<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CountryDataResource;
use App\Http\Resources\SummaryResource;
use App\Models\Country;
use App\Models\Statistic;
use Illuminate\Http\JsonResponse;

class StatisticsController extends Controller
{

    public function getCountryData(): JsonResponse
    {
        $countries = Country::with('statistic')->has('statistic')->get();
        return $this->success(data: CountryDataResource::collection($countries));
    }

    public function getSummary(): JsonResponse
    {
        $statistics = Statistic::all();
        return $this->success(data: new SummaryResource($statistics));
    }

}
