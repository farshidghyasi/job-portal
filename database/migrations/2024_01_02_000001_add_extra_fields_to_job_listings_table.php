<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('job_listings', function (Blueprint $table) {
            $table->string('country')->nullable()->after('location');
            $table->string('province')->nullable()->after('country');
            $table->string('work_arrangement')->default('onsite')->after('type'); // onsite, remote, hybrid
            $table->integer('num_vacancies')->default(1)->after('is_featured');
            $table->string('gender_preference')->default('any')->after('num_vacancies'); // male, female, any
            $table->json('skills_required')->nullable()->after('requirements');
            $table->json('skills_preferred')->nullable()->after('skills_required');
            $table->text('responsibilities')->nullable()->after('description');
            $table->string('years_of_experience')->nullable()->after('experience_level');
        });
    }

    public function down()
    {
        Schema::table('job_listings', function (Blueprint $table) {
            $table->dropColumn([
                'country', 'province', 'work_arrangement', 'num_vacancies',
                'gender_preference', 'skills_required', 'skills_preferred',
                'responsibilities', 'years_of_experience',
            ]);
        });
    }
};
