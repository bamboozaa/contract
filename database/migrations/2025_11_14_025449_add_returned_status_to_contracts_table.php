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
        Schema::table('contracts', function (Blueprint $table) {
            $table->boolean('is_returned')->default(false)->after('condition')->comment('สถานะการคืนเงินหลักประกัน');
            $table->date('returned_date')->nullable()->after('is_returned')->comment('วันที่คืนเงินหลักประกัน');
            $table->text('returned_note')->nullable()->after('returned_date')->comment('หมายเหตุการคืน');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('contracts', function (Blueprint $table) {
            $table->dropColumn(['is_returned', 'returned_date', 'returned_note']);
        });
    }
};
