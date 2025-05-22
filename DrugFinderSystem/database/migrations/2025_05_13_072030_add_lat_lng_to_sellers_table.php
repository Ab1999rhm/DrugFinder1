<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLatLngToSellersTable extends Migration
{
    public function up()
    {
        Schema::table('sellers', function (Blueprint $table) {
            $table->decimal('latitude', 10, 8)->nullable()->after('address');
            $table->decimal('longitude', 10, 8)->nullable()->after('latitude');
        });
    }

    public function down()
    {
        Schema::table('sellers', function (Blueprint $table) {
            $table->dropColumn(['latitude', 'longitude']);
        });
    }
}
