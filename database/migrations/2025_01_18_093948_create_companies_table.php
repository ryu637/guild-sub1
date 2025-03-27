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
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('address')->nullable();
            $table->string('website')->nullable();
            $table->decimal('total_spent', 10, 2)->default(0.00); // Total amount spent
            $table->string('representative')->nullable();
            $table->integer('employee')->nullable();
            $table->decimal('capital', 10, 2)->nullable();
            $table->decimal('annualsales', 10, 2)->nullable();
            $table->string('description')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
