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
        Schema::create('flavor_translations', function (Blueprint $table) {
            $table->id();
//            $table->integer('flavor_id')->unsigned();
            $table->string('locale')->index();
            $table->string('name');
            $table->timestamps();

            $table->unique(['flavor_id', 'locale']);
            $table->foreignId('flavor_id')->references('id')->on('flavors')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('flavor_translations');
    }
};
