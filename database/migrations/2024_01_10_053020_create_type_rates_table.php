<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('type_rates', function (Blueprint $table) {
            $table->id();
            $table->string('amount');
            $table->unsignedBigInteger('valuation_id')->nullable();
            $table->foreign('valuation_id')->on('id')->references('type_valuations')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('type_rates');
    }
};
