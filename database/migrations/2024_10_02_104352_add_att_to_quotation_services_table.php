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
        Schema::table('quotation_services', function (Blueprint $table) {
            $table->foreignId('parent_id')->nullable()->constrained('quotation_services')->onDelete('cascade');
            $table->string('service_name')->nullable()->after('service_id');
            $table->string('sub_service_name')->nullable()->after('service_id');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('quotation_services', function (Blueprint $table) {
            //
        });
    }
};
