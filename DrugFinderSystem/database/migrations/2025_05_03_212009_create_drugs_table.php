<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDrugsTable extends Migration
{
    public function up()
    {
        Schema::create('drugs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('seller_id');
            $table->string('name');
            $table->string('brand');
            $table->string('category');
            $table->string('dosage_form'); // e.g. tablet, syrup
            $table->string('strength');
            $table->integer('quantity');
            $table->decimal('price', 8, 2);
            $table->date('expiry_date');
            $table->text('description')->nullable();
            $table->timestamps();

            $table->foreign('seller_id')->references('id')->on('sellers')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('drugs');
    }
}
