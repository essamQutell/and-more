<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('quotations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->references('id')->on('projects')->onDelete('cascade');
            $table->foreignId('service_id')->references('id')->on('services')->onDelete('cascade');
            $table->double('price')->default(0.00);
            $table->double('quantity')->default(0.00);
            $table->integer('days')->default(0);
            $table->integer('margin')->default(0);
            $table->double('sales_price')->default(0.00);
            $table->double('cost')->default(0);
            $table->integer('agency_fee')->default(0.00);
            $table->double('total_discount')->default(0.00);
            $table->double('total_vat')->default(0.00);
            $table->double('total_cost')->default(0);
            $table->double('total_margin')->default(0);
            $table->double('total_sales')->default(0);
            $table->double('total_project')->default(0);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('quotations');
    }
};
