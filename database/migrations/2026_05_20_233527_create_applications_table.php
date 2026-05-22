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
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            $table->string('full_name');
            $table->string('phone');
            $table->string('gender');
            $table->date('dob');
            $table->text('address');

            $table->string('school');
            $table->string('qualification');
            $table->string('cgpa')->nullable();

            $table->string('passport')->nullable();

            $table->enum('status', ['draft', 'submitted','approved','rejected','under_review'])->default('draft');

            $table->timestamp('submitted_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applications');
    }
};
