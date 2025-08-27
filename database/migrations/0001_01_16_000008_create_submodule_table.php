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
        Schema::create('submodules', function (Blueprint $table) {
            $table->id('submodule_id');
            $table->unsignedBigInteger('module_id')->nullable();
            $table->string('submodule_name');
            $table->string('submodule_route_name');
            $table->text('submodule_description')->nullable();
            $table->boolean('submodule_status')->default(1);
            $table->timestamp('submodule_created')->useCurrent();
            $table->timestamp('submodule_updated')->useCurrent()->useCurrentOnUpdate();

            $table->foreign('module_id')->references('module_id')->on('modules')->onDelete('set null');;
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('submodules');
    }
};
