<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('warehouse_translations', function (Blueprint $table) {
            $table->id();
//            $table->integer('warehouse_id')->unsigned();
            $table->string('locale')->index();
            $table->string('name');
            $table->string('address', 200);
            $table->text('notes')->nullable();

            $table->unique(['warehouse_id', 'locale']);
            $table->foreignId('warehouse_id')->references('id')->on('warehouses')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('warehouse_translations');
    }
};
