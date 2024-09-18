<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('quotation_services', function (Blueprint $table) {
            $table->id();
            $table->foreignId('quotation_id')->nullable()->references('id')->on('quotations')->onDelete('cascade');
            $table->foreignId('service_id')->nullable()->references('id')->on('services')->onDelete('cascade');
            $table->double('price')->default(0.00);
            $table->double('quantity')->default(0.00);
            $table->integer('days')->default(0);
            $table->integer('margin')->default(0);
            $table->double('sales_price')->default(0.00);
            $table->double('cost')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('quotation_services');
    }
};
