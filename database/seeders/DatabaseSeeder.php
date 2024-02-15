<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Actions\Users\RegisterUserAction;
use App\Enums\RoleEnum;
use App\Models\Settings;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $Settings = Settings::query()->firstOrFail();

        if ($Settings->seed_version < 1) {
            $this->call(CitiesSeeder::class);
            $Settings->seed_version++;
        }

        if ($Settings->seed_version < 2) {
            (new RegisterUserAction)
                ->setName('Fernando Stefanutto')
                ->setCpf('000000000')
                ->setEmail('fhstefanutto@gmail.com')
                ->setRole('admin')
                ->handle();

            $Settings->seed_version++;
        }


        $Settings->saveOrFail();
    }
}
