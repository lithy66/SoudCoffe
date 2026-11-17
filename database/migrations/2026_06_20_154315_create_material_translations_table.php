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
        Schema::create('material_translations', function (Blueprint $table) {
            $table->id();
//            $table->integer('material_id')->unsigned();
            $table->string('locale')->index();
            $table->string('name',100);
            $table->text('description')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->unique(['material_id', 'locale']);
            $table->foreignId('material_id')->references('id')->on('materials')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('material_translations');
    }
};
