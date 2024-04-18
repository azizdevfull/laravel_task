<?php

namespace App\Console\Commands;

use App\Services\CurrencyIntegrationService;
use Illuminate\Console\Command;

class SyncCurrency extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:currency';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync Currency';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $currencyService = new CurrencyIntegrationService();
        $currencyService->fetchCountryCurrenciesAndStore();

        $this->info('Country currencies synced successfully!');
    }
}
