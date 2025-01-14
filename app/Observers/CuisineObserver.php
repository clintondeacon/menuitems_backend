<?php

namespace App\Observers;

use App\Models\Cuisine;
use Illuminate\Support\Str;

class CuisineObserver
{
    public function saving(Cuisine $cuisine): void
    {
        $slug = Str::slug($cuisine->name);
        $originalSlug = $slug;
        $count = 1;
        while (Cuisine::where('slug', $slug)->where('id', '!=', $cuisine->id)->exists()) {
            $slug = $originalSlug . '-' . $count++;
        }
        $cuisine->slug = $slug;
    }
}
