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
            $table->foreignId('quotation_service_id')->references('id')->on('quotation_services')
                ->after('deal_status_id')->onDelete('cascade')
               ;
            $table->date('start_date')->nullable()->after('deal_status_id');
            $table->date('end_date')->nullable()->after('deal_status_id');
            $table->integer('duration')->nullable()->after('deal_status_id');
            $table->integer('achievement')->nullable()->after('deal_status_id');
            $table->text('consequential_effect')->nullable()->after('deal_status_id');
            $table->text('notes')->nullable()->after('deal_status_id');
            $table->integer('progress_id')->nullable()->after('deal_status_id');
            $table->foreignId('project_id')->references('id')->on('projects')->after('deal_status_id')->onDelete('cascade');
            $table->dropForeign(['quotation_id']);
            $table->dropColumn('quotation_id');


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
