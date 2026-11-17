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
        Schema::create('material_category_translations', function (Blueprint $table) {
            $table->id();
//            $table->unsignedInteger('material_category_id')->unsigned();
            $table->string('locale',4)->index();
            $table->string('name');

            $table->unique(['material_category_id', 'locale'], 'mat_cat_trans_unique');
            $table->foreignId('material_category_id')->references('id')->on('material_categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('material_category_translations');
    }
};
