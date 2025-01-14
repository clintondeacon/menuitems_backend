<?php

namespace App\Http\Controllers;

use App\Http\Resources\CuisineSummaryResource;
use App\Models\Cuisine;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CuisineController extends Controller
{
    public function index(Request $request): JsonResource
    {
        // Get the slug from query parameters
        $slug = $request->query('cuisineSlug');

        // Fetch and return filtered cuisines based on the slug
        $query = Cuisine::query();

        if ($slug) {
            $query->where('slug', 'LIKE', "%{$slug}%");
        }

        // Paginate the results
        $cuisines = $query->withCount(['menuItems'])->withSum('menuItems' ,'number_of_orders')->paginate(20);

        // Return the resource collection with pagination
        return CuisineSummaryResource::collection($cuisines);
    }
}
