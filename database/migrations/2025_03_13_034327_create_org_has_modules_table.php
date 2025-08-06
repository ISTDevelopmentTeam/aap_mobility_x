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
        Schema::create('org_has_modules', function (Blueprint $table) {
            $table->unsignedBigInteger('org_id');
            $table->unsignedBigInteger('module_id');
        
            $table->foreign('org_id')
                  ->references('org_id')
                  ->on('organizations')
                  ->onDelete('cascade');
        
            $table->foreign('module_id')
                  ->references('module_id')
                  ->on('modules')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('organization_modules');
    }
};
