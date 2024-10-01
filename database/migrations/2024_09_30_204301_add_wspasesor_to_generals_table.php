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
        Schema::table('generals', function (Blueprint $table) {
            $table->string('support_one')->nullable();
            $table->string('whatsapp1')->nullable();
            $table->string('support_two')->nullable();
            $table->string('whatsapp2')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('generals', function (Blueprint $table) {
            $table->dropColumn('support_one');
            $table->dropColumn('whatsapp1');
            $table->dropColumn('support_two');
            $table->dropColumn('whatsapp2');
        });
    }
};
