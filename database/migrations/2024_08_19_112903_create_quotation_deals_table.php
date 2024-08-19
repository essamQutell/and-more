<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('quotation_deals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('quotation_id')->references('id')->on('quotations')->onDelete('cascade');
            $table->foreignId('supplier_id')->references('id')->on('suppliers')->onDelete('cascade');
            $table->foreignId('supplier_team_id')->references('id')->on('supplier_teams')->onDelete('cascade');
            $table->foreignId('project_admin_id')->references('id')->on('project_admins')->onDelete('cascade');
            $table->foreignId('status_id')->references('id')->on('statuses')->onDelete('cascade');
            $table->foreignId('deal_status_id')->references('id')->on('statuses')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('quotation_deals');
    }
};
