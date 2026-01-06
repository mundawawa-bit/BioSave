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
        Schema::table('flora', function (Blueprint $table) {
            $table->enum('approval_status', ['pending', 'approved', 'rejected'])
                ->default('pending')
                ->after('is_approved');
        });

        Schema::table('fauna', function (Blueprint $table) {
            $table->enum('approval_status', ['pending', 'approved', 'rejected'])
                ->default('pending')
                ->after('is_approved');
        });
    }

    public function down(): void
    {
        Schema::table('flora', function (Blueprint $table) {
            $table->dropColumn('approval_status');
        });

        Schema::table('fauna', function (Blueprint $table) {
            $table->dropColumn('approval_status');
        });
    }

};
