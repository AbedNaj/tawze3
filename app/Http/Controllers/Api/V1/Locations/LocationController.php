<?php

namespace App\Http\Controllers\Api\V1\Locations;

use App\Http\Controllers\Controller;
use App\Models\Tenants\Location;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        return Location::query()
            ->select('id', 'name')
            ->when(
                $request->search,
                fn(Builder $query) => $query
                    ->where('name', 'like', "%{$request->search}%")
            )
            ->orderBy('name')
            ->get();
    }
}
