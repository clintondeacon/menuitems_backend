<?php

namespace App\Http\Controllers;

use App\Http\Resources\MenuItemCollection;
use App\Models\Cuisine;
use App\Models\MenuItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class SetMenuController extends Controller
{
    public function index(Request $request): MenuItemCollection
    {

        $cacheKey = 'menu_items_page_' . request('page', 1) . '_cslug' . request('cuisineSlug', 1);;

        $menuItems = Cache::remember($cacheKey, now()->addMinutes(10), function () use($request) {

            $menuItems = MenuItem::with('cuisines');

            if($request->query('cuisineSlug')){
                $menuItems->whereHas('cuisines', function ($query) use ($request) {
                    $query->where('slug', $request->query('cuisineSlug'));
                });
            }

            return $menuItems->paginate(20);

        });

        return new MenuItemCollection($menuItems);

    }
}
