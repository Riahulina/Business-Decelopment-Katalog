<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('news', function (Blueprint $table) {
            $table->string('category')->default('Pengumuman')->after('slug');
            $table->text('quote')->nullable()->after('content');
            $table->string('quote_author')->nullable()->after('quote');
            $table->string('source')->default('Website BD')->after('cover_image');
            $table->string('attachment')->nullable()->after('source');
        });
    }

    public function down(): void
    {
        Schema::table('news', function (Blueprint $table) {
            $table->dropColumn(['category', 'quote', 'quote_author', 'source', 'attachment']);
        });
    }
};
