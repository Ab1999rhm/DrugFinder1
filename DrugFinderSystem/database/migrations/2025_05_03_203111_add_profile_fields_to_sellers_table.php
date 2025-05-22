<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddProfileFieldsToSellersTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('sellers', function (Blueprint $table) {
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->string('company_name')->nullable();
            $table->string('website')->nullable();
            $table->string('profile_image')->nullable();
            $table->string('bank_account')->nullable();
            $table->string('tax_id')->nullable();
            $table->text('bio')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('country')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('emergency_contact')->nullable();
            // Add more fields as needed for your application
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('sellers', function (Blueprint $table) {
            $table->dropColumn([
                'phone',
                'address',
                'company_name',
                'website',
                'profile_image',
                'bank_account',
                'tax_id',
                'bio',
                'date_of_birth',
                'city',
                'state',
                'country',
                'postal_code',
                'emergency_contact',
            ]);
        });
    }
}
