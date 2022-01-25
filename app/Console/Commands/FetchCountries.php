<?php

namespace App\Console\Commands;

use App\Models\Country;
use Http;
use Illuminate\Console\Command;

class FetchCountries extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'countries:fetch';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetches country data';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('Fetching...');
        $countriesRequest = Http::get('https://devtest.ge/countries');
        if ($countriesRequest->successful()) {
            $countries = $countriesRequest->json();
            foreach ($countries as $country) {
                Country::updateOrCreate([
                    'code' => $country['code']
                ], $country);
            }
            $this->info('Operation completed successfully');
            return 0;
        }
        $this->error('Operation completed unsuccessfully');
        return 0;
    }
}
