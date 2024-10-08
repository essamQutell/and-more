<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description')->nullable();
            $table->string('client_name')->nullable();
            $table->foreignId('status_id')->references('id')->on('statuses')->onDelete('cascade');
            $table->foreignId('deal_status_id')->references('id')->on('statuses')->onDelete('cascade');
            $table->integer('type_id')->nullable();
            $table->integer('project_id')->nullable();
            $table->string('location')->nullable();
            $table->integer('duration')->nullable();
            $table->string('venue')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
