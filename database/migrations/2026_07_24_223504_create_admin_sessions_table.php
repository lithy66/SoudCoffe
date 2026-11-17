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
        Schema::create('admin_sessions', function (Blueprint $table) {
            $table->id();
//            $table->integer('admin_id')->unsigned();
            $table->string('token');
            $table->enum('device_type', ['web', 'mobile', 'pos']);
            $table->string('device-name', 100);
            $table->string('ip_address', 45);
            $table->timestamp('last_activity');
            $table->boolean('is_active');
            $table->timestamps();

            $table->foreignId('admin_id')->references('id')->on('admins')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_sessions');
    }
};
