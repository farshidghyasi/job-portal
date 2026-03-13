<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('role')->default('jobseeker')->after('email'); // jobseeker, employer, freelancer, admin
            $table->string('phone')->nullable()->after('role');
            $table->string('location')->nullable()->after('phone');
            $table->string('avatar')->nullable()->after('location');
            $table->string('status')->default('active')->after('avatar'); // active, suspended
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['role', 'phone', 'location', 'avatar', 'status']);
        });
    }
};