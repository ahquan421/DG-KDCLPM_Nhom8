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
        Schema::table('addresses', function (Blueprint $table) {
            // Tăng độ dài cột phone và address
            $table->string('phone', 32)->change();
            $table->string('address', 512)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('addresses', function (Blueprint $table) {
            // Quay lại độ dài ban đầu
            $table->string('phone', 20)->change();
            $table->string('address', 255)->change();
        });
    }
};
