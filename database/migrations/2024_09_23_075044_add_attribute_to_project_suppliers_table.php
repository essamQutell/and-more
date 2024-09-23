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
        Schema::table('project_suppliers', function (Blueprint $table) {
            $table->foreignId('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->date('date')->nullable()->after('project_team_id');
            $table->string('city')->nullable()->after('project_team_id');
            $table->string('item')->nullable()->after('project_team_id');
            $table->integer('approvals')->nullable()->after('project_team_id');
            $table->integer('due_percentage')->default(0)->after('project_team_id');
            $table->double('total_cost')->default(0.00)->after('project_team_id');
            $table->double('deposit')->default(0.00)->after('project_team_id');
            $table->double('discount')->default(0.00)->after('project_team_id');
            $table->double('actual_cost')->default(0.00)->after('project_team_id');
            $table->integer('attachment_id')->nullable()->after('project_team_id');


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('project_suppliers', function (Blueprint $table) {
            //
        });
    }
};
