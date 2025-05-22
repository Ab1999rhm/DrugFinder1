<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveLatLngFromSellersTable extends Migration
{
    public function up()
    {
        Schema::table('sellers', function (Blueprint $table) {
            // Drop latitude and longitude columns if they exist
            if (Schema::hasColumn('sellers', 'latitude') && Schema::hasColumn('sellers', 'longitude')) {
                $table->dropColumn(['latitude', 'longitude']);
            }
        });
    }

    public function down()
    {
        Schema::table('sellers', function (Blueprint $table) {
            // Recreate latitude and longitude columns on rollback
            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();
        });
    }
}
