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
        Schema::table('products', function (Blueprint $table) {
            // Thêm cột slug
            $table->string('slug')->nullable()->after('name');

            // Đổi kiểu quantity sang unsigned
            $table->unsignedInteger('quantity')->default(0)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
             // Xóa cột slug
            $table->dropColumn('slug');

            // Đổi lại kiểu quantity về kiểu cũ
            $table->integer('quantity')->change();
        });
    }
};
