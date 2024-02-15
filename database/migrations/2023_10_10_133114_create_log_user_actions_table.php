<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * tipo_registro, fkidregistro
     */
    public function up(): void
    {
        Schema::create('log_user_actions', function (Blueprint $table) {
            $table->id();
            $table->enum('event', ['create', 'update', 'delete']);
            $table->string('table', 64);
            $table->json('old_data')->nullable();
            $table->json('new_data')->nullable();
            $table->bigInteger('register_id');
            $table->foreignIdFor(User::class)->nullable();
            $table->timestamps();
        });
    }

    /**
     * 
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('log_user_actions');
    }
};
