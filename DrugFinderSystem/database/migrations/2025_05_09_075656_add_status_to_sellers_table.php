<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('sellers', function (Blueprint $table) {
            // Add a string status column, nullable or with default value as needed
            $table->string('status')->default('pending')->after('email');
        });
    }

    public function down()
    {
        Schema::table('sellers', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};
