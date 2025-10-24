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
        if (!Schema::hasColumn('contracts', 'formFile_description')) {
            Schema::table('contracts', function (Blueprint $table) {
                $table->text('formFile_description')->nullable()->after('formFile');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumn('contracts', 'formFile_description')) {
            Schema::table('contracts', function (Blueprint $table) {
                $table->dropColumn('formFile_description');
            });
        }
    }
};
