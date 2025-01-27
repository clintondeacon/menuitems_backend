<?php

namespace App\Http\Controllers;

use App\Http\Resources\MenuItemCollection;
use App\Http\Resources\MenuItemResource;
use App\Models\MenuItem;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class SetMenuController extends Controller
{
    /**
     * GET: /set-menus.
     *
     * @group Menus
     * @unauthenticated
     *
     * @queryParam cuisineSlug The cuisine the menu items need to be assigned to
     * @queryParam page The page number. Example: [1,2] Default: 1
     *
     * @apiResource App\Http\Resources\MenuItemCollection
     * @apiResourceModel App\Models\MenuItem
     *
     * @return JsonResponse
     */
    public function index(Request $request): MenuItemCollection
    {

        $cacheKey = 'menu_items_page_' . request('page', 1) . '_cslug' . request('cuisineSlug', 1);

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

    /**
     * GET: /menu-item/{id}.
     *
     * @group Menus
     * @unauthenticated
     *
     * @queryParam id The id for the menu item. Example: [1,2]
     *
     * @apiResource App\Http\Resources\MenuItemResource
     * @apiResourceModel App\Models\MenuItem
     *
     * @return JsonResponse
     */
    public function get(
        Request $request,
    ): JsonResponse {
        return response()->json(new MenuItemResource(MenuItem::find($request->id)));
    }

}
