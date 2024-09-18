<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('project_suppliers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->constrained('projects')->onDelete('cascade');
            $table->foreignId('supplier_id')->constrained('suppliers')->onDelete('cascade');
            $table->foreignId('quotation_id')->constrained('quotations')->onDelete('cascade');
            $table->foreignId('project_team_id')->constrained('project_admins')->onDelete('cascade');
            $table->integer('accrual_percentage')->default(0);
            $table->double('paid')->default(0.00);
            $table->double('remain')->default(0.00);
            $table->text('note')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('project_suppliers');
    }
};
