<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            // Đổi tên cột 'date' thành 'order_date'
            $table->renameColumn('date', 'order_date');
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            // Nếu rollback, đổi lại tên cũ
            $table->renameColumn('order_date', 'date');
        });
    }
};
