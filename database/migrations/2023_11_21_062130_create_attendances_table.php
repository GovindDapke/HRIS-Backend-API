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
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employee_id');
            $table->date('date')->nullable();
            $table->boolean('status')->default(false);
            $table->string('temperature')->nullable();
            $table->string('spo2')->nullable();
            $table->string('heart_rate')->nullable();
            $table->string('mood')->nullable();
            // $table->enum('punch_type', ['in', 'out']); // Punch type: 'in' or 'out'
            $table->foreign('employee_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamp('login_time')->nullable();
            $table->timestamp('logout_time')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('attendances');
    }
};
