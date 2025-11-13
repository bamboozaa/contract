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
            // Index สำหรับ filter หลักประกัน
            $table->index('types_of_guarantee', 'idx_types_of_guarantee');

            // Index สำหรับ filter เงื่อนไขการคืน
            $table->index('condition', 'idx_condition');

            // Index สำหรับการคำนวณวันคืน
            $table->index('duration', 'idx_duration');
            $table->index('contract_date', 'idx_contract_date');

            // Composite index สำหรับ query ที่ใช้บ่อย
            $table->index(['types_of_guarantee', 'condition', 'duration'], 'idx_guarantee_composite');

            // Index สำหรับ filter ปี
            $table->index('contract_year', 'idx_contract_year');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('contracts', function (Blueprint $table) {
            // ลบ indexes
            $table->dropIndex('idx_types_of_guarantee');
            $table->dropIndex('idx_condition');
            $table->dropIndex('idx_duration');
            $table->dropIndex('idx_contract_date');
            $table->dropIndex('idx_guarantee_composite');
            $table->dropIndex('idx_contract_year');
        });
    }
};
