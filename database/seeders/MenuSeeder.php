<?php

namespace Database\Seeders;

use App\Models\Cuisine;
use App\Models\MenuItem;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pages = 10;
        $client = new Client();

        for($i = 2; $i <= $pages; $i++) {

            $rawResponse = $client->request('GET', 'https://staging.yhangry.com/booking/test/set-menus?page='.$i)->getBody()->getContents();
            $data = json_decode($rawResponse,true);

//            dump('https://staging.yhangry.com/booking/test/set-menus?page='.$i,$data);

            foreach ($data['data'] as $item) {

                $menuItem = MenuItem::create([
                    'name' => Arr::get($item, 'name'),
                    'description' => Arr::get($item, 'description'),
                    'display_text' => Arr::get($item, 'display_text'),
                    'image' => Arr::get($item, 'image'),
                    'thumbnail' => Arr::get($item, 'thumbnail'),
                    'is_vegan' => (bool) Arr::get($item, 'is_vegan'),
                    'is_vegetarian' => (bool) Arr::get($item, 'is_vegetarian'),
                    'status' => (bool) Arr::get($item, 'status'),
                    'groups' => Arr::get($item, 'groups'),
                    'price_per_person' => Arr::get($item, 'price_per_person'),
                    'min_spend' => Arr::get($item, 'min_spend'),
                    'is_seated' => (bool) Arr::get($item, 'is_seated'),
                    'is_standing' => (bool) Arr::get($item, 'is_standing'),
                    'is_canape' => (bool) Arr::get($item, 'is_canape'),
                    'is_mixed_dietary' => (bool) Arr::get($item, 'is_mixed_dietary'),
                    'is_meal_prep' => (bool) Arr::get($item, 'is_meal_prep'),
                    'is_halal' => (bool) Arr::get($item, 'is_halal'),
                    'is_kosher' => (bool) Arr::get($item, 'is_kosher'),
                    'price_includes' => Arr::get($item, 'price_includes'),
                    'highlight' => Arr::get($item, 'highlight'),
                    'available' => Arr::get($item, 'available'),
                    'number_of_orders' => Arr::get($item, 'number_of_orders'),
                    'created_at' => Carbon::parse(Arr::get($item, 'created_at'))
                ]);

                foreach(Arr::get($item,'cuisines') as $cuisineData) {
                    $cuisine = Cuisine::updateOrCreate(['name' => Arr::get($cuisineData, 'name')]);
                    $menuItem->cuisines()->attach($cuisine);
                }
            }

            sleep(1);
        }

    }

}
