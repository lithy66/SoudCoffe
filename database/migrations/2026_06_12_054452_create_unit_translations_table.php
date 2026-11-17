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
        Schema::create('unit_translations', function (Blueprint $table) {
            $table->id();
//            $table->integer('unit_id')->unsigned();
            $table->string('locale')->index();
            $table->string('name', 50);
            $table->timestamps();

            $table->unique(['unit_id', 'locale']);
            $table->foreignId('unit_id')->references('id')->on('units')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('unit_translations');
    }
};
