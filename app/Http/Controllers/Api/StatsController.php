<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\StatResource;
use App\Models\Statistics;

class StatsController extends Controller
{
    public function __invoke()
    {
        return StatResource::collection(
            Statistics::top()->with('user')->take(10)->get()
        );
    }
}
