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
        Schema::create('roast_level_translations', function (Blueprint $table) {
            $table->id();
//            $table->integer('roast_level_id')->unsigned();
            $table->string('locale')->index();
            $table->string('name');
            $table->timestamps();

            $table->unique(['roast_level_id', 'locale']);
            $table->foreignId('roast_level_id')->references('id')->on('roast_levels')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('roast_level_translations');
    }
};
