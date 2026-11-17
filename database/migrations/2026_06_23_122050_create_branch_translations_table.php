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
        Schema::create('branch_translations', function (Blueprint $table) {
            $table->id();
//            $table->integer('branch_id')->unsigned();
            $table->string('locale')->index();
            $table->string('name',50);
            $table->string('address',200);

            $table->unique(['locale', 'branch_id']);
            $table->foreignId('branch_id')->references('id')->on('branches')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('branche_translations');
    }
};
