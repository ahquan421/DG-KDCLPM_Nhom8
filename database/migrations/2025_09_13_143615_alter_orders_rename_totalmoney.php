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
        Schema::table('orders', function (Blueprint $table) {
            // Đổi tên cột từ totalMoney sang total_money
            $table->renameColumn('totalMoney', 'total_money');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            // Quay lại tên cột ban đầu
            $table->renameColumn('total_money', 'totalMoney');
        });
    }
};
