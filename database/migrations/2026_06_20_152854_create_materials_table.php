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
        Schema::create('materials', function (Blueprint $table) {
            $table->id();
            $table->string('code', 30)->nullable();
//            $table->integer('material_category_id')->unsigned();
//            $table->integer('unit_id')->unsigned();
            $table->integer('roast_level_id')->nullable();
            $table->string('barcode',50)->nullable();
            $table->decimal('min_stock_level', 10,3);
            $table->decimal('reorder_level', 10,3);
            $table->decimal('max_stock_level', 10,3);
            $table->decimal('cost_price', 10,2);
            $table->string('currency', 5)->nullable();
            $table->integer('shelf_life_days')->nullable();
            $table->boolean('is_perishable');
            $table->boolean('is_active')->default(1);
            $table->softDeletes();
            $table->timestamps();

            $table->foreignId('material_category_id')->references('id')->on('material_categories')->onDelete('cascade');
            $table->foreignId('unit_id')->references('id')->on('units')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('materials');
    }
};
