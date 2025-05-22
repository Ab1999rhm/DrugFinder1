<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOrdersSeenAtToSellersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
   // database/migrations/xxxx_xx_xx_add_orders_seen_at_to_sellers_table.php
public function up()
{
    Schema::table('sellers', function (Blueprint $table) {
        $table->timestamp('orders_seen_at')->nullable();
    });
}
public function down()
{
    Schema::table('sellers', function (Blueprint $table) {
        $table->dropColumn('orders_seen_at');
    });
}

}
