<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('gallery_user', function (Blueprint $table) {
            // Menambahkan kolom Role dengan nilai default 'user'
            $table->string('Role', 20)->default('user')->after('Alamat');
        });
    }

    public function down(): void
    {
        Schema::table('gallery_user', function (Blueprint $table) {
            $table->dropColumn('Role');
        });
    }
};