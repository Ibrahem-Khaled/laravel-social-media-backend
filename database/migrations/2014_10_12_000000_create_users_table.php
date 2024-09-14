<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->enum('role',['superAdmin','admin','user','editor'])->default('user');
            $table->string('image')->nullable();
            $table->string('phone')->nullable()->unique();
            $table->string('address')->nullable();
            $table->enum('gender',['male','female'])->nullable();
            $table->date('date_of_birth')->nullable();
            $table->timestamp('last_login_at')->nullable();
            $table->timestamp('last_logout_at')->nullable();
            $table->timestamp('last_activity_at')->nullable();
            $table->ipAddress('last_login_ip')->nullable();
            $table->ipAddress('last_logout_ip')->nullable();
            $table->ipAddress('last_activity_ip')->nullable();
            $table->boolean('status')->default(true);
            $table->string('slug')->nullable()->unique();
            $table->string('password');
            $table->boolean('following_privacy')->default(false);
            $table->integer('following')->default(0);
            $table->integer('followers')->default(0);
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
