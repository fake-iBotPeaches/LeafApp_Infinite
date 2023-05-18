<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('playlists', function (Blueprint $table) {
            $table->boolean('is_active')->after('is_ranked')->default(false);
        });
    }

    public function down(): void
    {
        Schema::table('playlists', function (Blueprint $table) {
            $table->dropColumn('is_active');
        });
    }
};
