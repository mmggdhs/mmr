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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('dev_id');
            $table->string('title')->index()->unique();
            $table->string('lang')->index();
            $table->longText('content');
            $table->timestamp('date')->useCurrent();
            $table->string('video')->nullable();
            $table->longText('file');
            $table->string(('link'))->nullable();
            $table->foreign('dev_id')->references('id')->on('users')->onDelete('cascade');
        });
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('project_id');
            $table->longText('details');
            // $table->timestamp('date')->useCurrent();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
        Schema::dropIfExists('reports');


    }
};
