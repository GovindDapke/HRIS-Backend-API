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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('employee_number')->unique()->nullable();
            $table->string('name');
            $table->string('last_name')->nullable();
            $table->string('date_of_birth')->nullable();
            $table->string('date_of_joining')->nullable();
            $table->string('gender')->nullable();
            $table->string('email')->unique();
            $table->string('marital_status')->nullable();
            $table->string('mobile')->nullable();
            $table->string('alternate_mobile_number')->nullable();
            $table->string('password')->nullable();
            $table->string('address')->nullable();
            $table->boolean('is_active')->default(1);
            $table->unsignedBigInteger('role_id')->default(2);
            $table->unsignedBigInteger('department_id')->nullable();
            $table->unsignedBigInteger('designation_id')->nullable();
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('cascade');
            $table->foreign('designation_id')->references('id')->on('designations')->onDelete('cascade');
            $table->softDeletes();
            $table->timestamps();
        });
    }
//php artisan migrate:fresh --seed 
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
