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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_no', 255)->nullable();
            $table->string('customer_name', 255)->nullable(); 
            $table->string('customer_email', 255)->nullable();
            $table->string('customer_mob_no', 255)->nullable();
            $table->integer('customer_country_id')->nullable();
            $table->integer('product_type_id')->nullable();
            $table->text('products_id')->nullable();
            $table->float('order_amount', 10, 2)->nullable();
            $table->dateTime('created_date')->nullable();
            $table->integer('created_by')->nullable()->unsigned();
            $table->dateTime('modified_date')->nullable();
            $table->integer('modified_by')->nullable()->unsigned();
            $table->integer('is_deleted')->default(0)->nullable();
            $table->dateTime('deleted_date')->nullable();
            $table->integer('deleted_by')->nullable()->unsigned();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order');
    }
};
