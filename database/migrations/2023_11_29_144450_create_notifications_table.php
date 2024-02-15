<?php

use App\Models\User;
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
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class);
            $table->string('icon', 32)->default('ChatBubbleLeftRightIcon');
            $table->string('icon_background', 32)->default('bg-sky-800');
            $table->string('title', 128)->nullable();
            $table->string('label', 256)->nullable();
            $table->boolean('has_open')->default(false);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
