<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDrugRatingsTable extends Migration
{
    public function up()
    {
        Schema::create('drug_ratings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('drug_id')->constrained()->onDelete('cascade');
            $table->tinyInteger('rating');
            $table->timestamps();

            $table->unique(['user_id', 'drug_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('drug_ratings');
    }
}
