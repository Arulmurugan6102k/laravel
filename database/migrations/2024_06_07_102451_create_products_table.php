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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('product_name', 255);
            $table->float('product_cost');
            $table->string('prod_type_name', 255);
            $table->string('release_date', 255);
            $table->string('version_id', 255);
            $table->binary('product_image')->nullable();
            $table->text('product_description');
            $table->text('available_colors');
            $table->dateTime('created_date')->nullable();
            $table->integer('created_by', false, true)->nullable();
            $table->dateTime('modified_date')->nullable();
            $table->integer('modified_by', false, true)->nullable();
            $table->integer('is_deleted')->default(0)->nullable();
            $table->dateTime('deleted_date')->nullable();
            $table->integer('deleted_by', false, true)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
