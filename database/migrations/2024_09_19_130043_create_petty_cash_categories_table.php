<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('petty_cash_categories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('petty_cash_id')->references('id')->on('petty_cashes')
                ->onDelete('cascade');
            $table->foreignId('supplier_id')->references('id')->on('suppliers')
                ->onDelete('cascade');
            $table->foreignId('category_id')->references('id')->on('categories')
                ->onDelete('cascade');
            $table->integer('item')->default(0);
            $table->integer('attachment')->default(0);
            $table->integer('invoice_number')->default(0);
            $table->double('invoice_value')->default(0.0);
            $table->string('city', 255);
            $table->string('responsible', 255);
            $table->text('notes')->nullable();
            $table->date('date');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('petty_cash_categories');
    }
};
