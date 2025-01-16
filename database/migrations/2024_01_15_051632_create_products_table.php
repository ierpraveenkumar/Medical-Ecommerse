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
            $table->unsignedBigInteger('batch_id');
            $table->string('name');
            $table->float('price');
            $table->enum('type', ['Kit', 'Strips']);
            $table->string('hsn_code');
            $table->float('gross_weight');
            $table->float('net_weight');
            $table->integer('quantity')->default(1);
            $table->float('unit_price');
            $table->float('final_price');
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('batch_id')->references('id')->on('batches')->onDelete('cascade');
       
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
