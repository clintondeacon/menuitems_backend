<?php

namespace App\Http\Controllers;

use App\Http\Resources\MenuItemCollection;
use App\Models\Cuisine;
use App\Models\MenuItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class SetMenuController extends Controller
{
    public function index(): MenuItemCollection
    {

        $cacheKey = 'menu_items_page_' . request('page', 1);

        $menuItems = Cache::remember($cacheKey, now()->addMinutes(10), function () {
            return MenuItem::with('cuisines')->paginate(20);
        });

        return new MenuItemCollection($menuItems);

    }
}
