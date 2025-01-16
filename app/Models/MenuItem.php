<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class MenuItem extends Model
{
    use SoftDeletes, HasFactory;

    /**
     * The database table that should be used by the model.
     *
     * @var string
     */
    protected $table = 'menu_items';

    /**
     * The attributes that are mass assignable.
     *
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'display_text',
        'image',
        'thumbnail',
        'is_vegan',
        'is_vegetarian',
        'status',
        'groups',
        'price_per_person',
        'min_spend',
        'is_seated',
        'is_standing',
        'is_canape',
        'is_mixed_dietary',
        'is_meal_prep',
        'is_halal',
        'is_kosher',
        'price_includes',
        'highlight',
        'available',
//        'number_of_orders'
    ];

    /**
     * The attributes that should be hidden from array.
     *
     * @var array
     */
    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'display_text' => 'boolean',
        'is_vegan' => 'boolean',
        'is_vegetarian' => 'boolean',
        'status' => 'boolean',
        'price_per_person' => 'float',
        'min_spend' => 'float',
        'is_seated' => 'boolean',
        'is_standing' => 'boolean',
        'is_canape' => 'boolean',
        'is_meal_prep' => 'boolean',
        'is_halal' => 'boolean',
        'is_kosher' => 'boolean',
        'number_of_orders' => 'integer',
        'is_mixed_dietary' => 'boolean',
        'groups' => 'array',
    ];

    public function cuisines()
    {
        return $this->belongsToMany(Cuisine::class);
    }

}
