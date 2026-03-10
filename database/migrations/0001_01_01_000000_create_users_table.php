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
    Schema::create('gallery_user', function (Blueprint $table) {
        $table->id('UserID');
        $table->string('Username', 255)->unique();
        $table->string('Password', 255);
        $table->string('Email', 255)->unique();
        $table->string('NamaLengkap', 255);
        $table->text('Alamat');
        $table->timestamps(); // Opsional dari Laravel, biarkan saja agar aman
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
