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
        Schema::table('applications', function (Blueprint $table) {
            //
             $table->string('school')->nullable()->change();
             $table->string('qualification')->nullable()->change();
             $table->string('cgpa')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('applications', function (Blueprint $table) {
            //
            $table->string('school')->nullable(false)->change();
             $table->string('qualification')->nullable(false)->change();
        });
    }
};
