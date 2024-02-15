<?php

use App\Enums\ApiGeolocationEnum;
use App\Models\Settings;
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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->integer('seed_version')->comment('Controle de versionamento das seeds');
            // $table->enum('api_geolocation', [
            //     ApiGeolocationEnum::Google->value,
            //     ApiGeolocationEnum::BrasilApi->value,
            // ])->comment('Set a API que a plataforma vai utilizar. ["Google", "BrasilApi"]');
            $table->integer('clear_log_user_actions')->comment('Número de dias que deve manter esse log');
            $table->boolean('clear_all_cache')->default(false)->comment('Ao colocar essa variável como TRUE quando o CRON passar todos os cache do sistemas seram limpos');
            $table->timestamps();
        });

        Settings::query()->create([
            'seed_version' => 0,
            // 'api_geolocation' => ApiGeolocationEnum::BrasilApi->value,
            'clear_log_user_actions' => 90
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
