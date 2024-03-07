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
        Schema::create('contracts', function (Blueprint $table) {
            $table->id('contract_id')->comment('(รหัสสัญญา): รหัสที่ระบุสัญญา');
            $table->string('contract_name')->comment(' (ชื่อสัญญา): ชื่อหรือคำอธิบายของสัญญา');
            $table->date('start_date')->comment('(วันที่เริ่มสัญญา): วันที่สัญญาเริ่มต้น');
            $table->date('end_date')->comment('(วันที่สิ้นสุดสัญญา): วันที่สัญญาสิ้นสุด');
            $table->string('parties_involved')->comment(' (ฝ่ายที่เกี่ยวข้อง): ฝ่ายหรือบุคคลที่เกี่ยวข้องกับสัญญา');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contracts');
    }
};
