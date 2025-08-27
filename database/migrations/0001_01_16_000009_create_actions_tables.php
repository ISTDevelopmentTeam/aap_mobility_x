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
        Schema::create('actions', function (Blueprint $table) {
            $table->id('action_id');
            $table->unsignedBigInteger('submodule_id');
            $table->string('action_name');
            $table->text('action_description')->nullable();
            $table->boolean('action_status')->default(1);
            $table->timestamp('action_created')->useCurrent();
            $table->timestamp('action_updated')->useCurrent()->useCurrentOnUpdate();

            $table->foreign('submodule_id')->references('submodule_id')->on('submodules')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('actions');
    }
};
