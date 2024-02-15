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
            $table->string('cpf', 14)->nullable();
            $table->boolean('active')->default(true);
            $table->text('profile_photo')->nullable();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('flag_id');
            $table->dropColumn('contractor_id');
            $table->dropColumn('industry_id');
            $table->dropColumn('cpf');
            $table->dropColumn('active');
            $table->dropColumn('profile_photo');
            $table->dropSoftDeletes();
        });
    }
};
