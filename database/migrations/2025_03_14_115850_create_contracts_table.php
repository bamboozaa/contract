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
            $table->id();
            $table->char('contract_no')->comment('เลขที่สัญญา): เลขที่ระบุสัญญา');
            $table->char('contractid')->nullable()->comment('เลขที่สัญญาเช่ากองอาคาร');
            $table->char('contract_year')->comment('ปีการศึกษา พ.ศ.');
            $table->integer('dep_id');
            $table->string('contract_name')->comment(' (ชื่อสัญญา): ชื่อหรือคำอธิบายของสัญญา');
            $table->string('partners')->comment(' (ชื่อคู่สัญญา): ชื่อหรือคำอธิบายของคู่สัญญา');
            $table->decimal('acquisition_value', 10, 2)->comment('(มูลค่างาน): ชื่อหรือคำอธิบายของมูลค่างานตามสัญญา');
            $table->string('fund')->nullable()->comment('(กองทุน): ชื่อหรือคำอธิบายของกองทุน');
            $table->integer('contract_type')->comment('ประเภทสัญญา');
            $table->date('contract_date')->nullable()->comment('วันที่ลงนามในสัญญา');
            $table->date('start_date')->nullable()->comment('(วันที่เริ่มสัญญา): วันที่สัญญาเริ่มต้น');
            $table->date('end_date')->nullable()->comment('(วันที่สิ้นสุดสัญญา): วันที่สัญญาสิ้นสุด');
            $table->integer('types_of_guarantee')->nullable()->comment('ชนิดเงินค้ำหลักประกันสัญญา');
            $table->decimal('guarantee_amount', 10, 2)->nullable()->comment('จำนวนเงินประกันสัญญา');
            $table->integer('duration')->nullable();
            $table->integer('condition')->nullable();
            $table->string('formFile')->nullable();
            $table->string('assignee')->nullable();
            $table->integer('status')->default(1)->nullable();
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
