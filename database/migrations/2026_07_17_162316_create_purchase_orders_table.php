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
        Schema::create('purchase_orders', function (Blueprint $table) {
            $table->id();
            $table->string('po_number', 30);
            $table->foreignId('supplier_id')->references('id')->on('suppliers')->onDelete('cascade');
            $table->foreignId('warehouse_id')->references('id')->on('warehouses')->onDelete('cascade');
//            $table->integer('supplier_id')->unsigned();
//            $table->integer('warehouse_id')->unsigned();
            $table->enum('status', ['draft', 'sent', 'partially_received', 'received', 'cancelled']);
            $table->date('order_date');
            $table->date('expected_date')->nullable();
            $table->date('received_date')->nullable();
            $table->decimal('subtotal', 10,2)->nullable();
            $table->decimal('tax_amount', 10,2)->nullable();
            $table->decimal('discount_amount', 10,2)->nullable();
            $table->decimal('total_amount', 10,2)->nullable();
            $table->string('currency', 5)->nullable();
            $table->text('notes')->nullable();
            $table->foreignId('created_by')->references('id')->on('admins')->onDelete('cascade');
//            $table->integer('created_by')->unsigned();
            $table->integer('approved_by')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_orders');
    }
};
