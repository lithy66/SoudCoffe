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
        Schema::create('supplier_translations', function (Blueprint $table) {
            $table->id();
//            $table->integer('supplier_id')->unsigned();
            $table->string('locale')->index();
            $table->string('company_name', 50);
            $table->text('address');
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->unique(['supplier_id', 'locale']);
            $table->foreignId('supplier_id')->references('id')->on('suppliers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('supplier_translations');
    }
};
