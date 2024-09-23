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
        Schema::table('quotation_deals', function (Blueprint $table) {
            $table->dropForeign(['quotation_service_id']);
            $table->dropColumn('quotation_service_id');
            $table->foreignId('service_id')->references('id')->on('services')->onDelete('cascade')
            ->after('deal_status_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('quotation_deals', function (Blueprint $table) {
            //
        });
    }
};
