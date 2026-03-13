<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('job_listing_id')->constrained()->onDelete('cascade');
            $table->foreignId('jobseeker_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('resume_id')->nullable()->constrained()->onDelete('set null');
            $table->text('cover_letter')->nullable();
            $table->string('status')->default('pending'); // pending, reviewed, shortlisted, rejected, hired
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('applications');
    }
};