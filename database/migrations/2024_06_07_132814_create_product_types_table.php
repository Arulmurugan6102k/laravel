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
        Schema::create('product_types', function (Blueprint $table) {
            $table->increments('main_id'); 
            $table->string('product_type_name', 255)->nullable(); 
            $table->string('product_type_code', 255)->nullable(); 
            $table->integer('is_active')->default(1)->nullable();
            $table->dateTime('created_date')->nullable();
            $table->integer('created_by')->nullable(); 
            $table->dateTime('modified_date')->nullable();
            $table->integer('modified_by')->nullable();
            $table->integer('is_deleted')->default(0);
            $table->dateTime('deleted_date')->nullable();
            $table->integer('deleted_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_types');
    }
};
