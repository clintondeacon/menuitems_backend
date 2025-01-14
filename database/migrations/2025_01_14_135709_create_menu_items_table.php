<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('menu_items', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->boolean('display_text');
            $table->string('image');
            $table->string('thumbnail');
            $table->boolean('is_vegan')->default(false);
            $table->boolean('is_vegetarian')->default(false);
            $table->boolean('is_canape')->default(false);
            $table->boolean('status')->default(false);
            $table->json('groups')->nullable();
            $table->double('price_per_person')->default(0);
            $table->boolean('min_spend')->default(false);
            $table->boolean('is_seated')->default(false);
            $table->boolean('is_standing')->default(false);
            $table->boolean('is_mixed_dietary')->default(false);
            $table->boolean('is_meal_prep')->default(false);
            $table->boolean('is_halal')->default(false);
            $table->boolean('is_kosher')->default(false);
            $table->text('price_includes')->nullable();
            $table->text('highlight')->nullable();
            $table->boolean('available');
            $table->unsignedInteger('number_of_orders')->default(0);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('model_items');
    }
};
