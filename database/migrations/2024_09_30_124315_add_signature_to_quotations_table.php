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
        Schema::table('quotations', function (Blueprint $table) {
            $table->longText('scope_work_signature')->nullable()->after('status');
            $table->longText('scope_work_stamp')->nullable()->after('status');
            $table->longText('delivery_note_signature')->nullable()->after('status');
            $table->longText('delivery_note_stamp')->nullable()->after('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('quotations', function (Blueprint $table) {
            //
        });
    }
};
