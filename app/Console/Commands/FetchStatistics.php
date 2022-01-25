<?php

namespace App\Console\Commands;

use App\Models\Country;
use Http;
use Illuminate\Console\Command;
use function now;

class FetchStatistics extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'statistics:fetch';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetches statistics data';

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
        $updated = 0;
        $new = 0;
        Country::with('statistic')->get()->each(function (Country $country) use (&$updated, &$new) {
            $statistic = $country->statistic;

            if (!$statistic) {
                $new++;
                $this->updateStatistic($country);
                return;
            }

            if (now()->diffInDays($statistic->updated_at) >= 1) {
                $updated++;
                $this->updateStatistic($country);
            }

        });
        $this->info("Completed. New: $new; Updated: $updated");
        return 0;
    }

    private function updateStatistic(Country $country)
    {
        if ($statistics = $this->getStatistics($country)) {
            $country->statistic()->updateOrCreate([], $statistics);
            $country->statistic()->touch();
        }
    }

    private function getStatistics(Country $country): ?array
    {
        $statisticRequest = Http::post('https://devtest.ge/get-country-statistics', [
            'code' => $country->code
        ]);
        return $statisticRequest->successful() ? $statisticRequest->json() : null;
    }
}
