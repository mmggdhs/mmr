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
            $table->integer('dev_id')->unsigned();
            $table->string('title')->index();
            $table->string('lang')->index();
            $table->longText('content');
            $table->timestamp('date')->useCurrent();
            $table->string('video');
            $table->longText('file');
            $table->string(('link'))->nullable();
            $table->foreign('dev_id')->references('id')->on('users')->onDelete('SET NULL');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');

    }
};
