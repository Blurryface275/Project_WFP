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
        Schema::table('users', function (Blueprint $table) {
            // tambahkan kolom role dengan tipe enum (admin, doctor, member) default value -> member
            $table->enum('role', ['admin', 'doctor', 'member'])->default('member');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // drop kolom role
            $table->dropColumn('role');
        });
    }
};
