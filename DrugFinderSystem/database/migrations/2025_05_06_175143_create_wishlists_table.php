<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWishlistsTable extends Migration
{
    public function up()
    {
        Schema::create('wishlists', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('drug_id')->constrained()->onDelete('cascade');
            $table->string('prescription_note')->nullable();
            $table->timestamps();
            $table->unique(['user_id', 'drug_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('wishlists');
    }
}
