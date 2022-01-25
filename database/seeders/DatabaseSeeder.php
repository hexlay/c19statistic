<?php

namespace Database\Seeders;

use App\Models\Country;
use App\Models\Statistic;
use App\Models\User;
use Artisan;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Statistic::reguard();
        Country::reguard();

        User::factory()->create();
        Artisan::call('countries:fetch');
        Artisan::call('statistics:fetch');

        $user = User::first();
        $this->command->getOutput()->writeln("User info: email = $user->email, password = VeryLongPasswordForSafety");
    }
}
