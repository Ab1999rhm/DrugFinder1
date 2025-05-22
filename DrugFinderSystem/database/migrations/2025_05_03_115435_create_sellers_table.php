<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSellersTable extends Migration
{
    public function up()
    {
        Schema::create('sellers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('shop_name')->nullable();
            $table->string('location_coordinates')->nullable();
            $table->string('contact_number')->nullable();
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
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('sellers');
    }
}
