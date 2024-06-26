<?php

namespace App\Services;

use App\Models\CountryCurrency;
use Illuminate\Support\Facades\Http;

class CurrencyIntegrationService
{
    public function fetchCountryCurrenciesAndStore()
    {
        $currencies = $this->fetchCountryCurrencies();

        foreach ($currencies as $countryCode => $currencyCode) {
            CountryCurrency::updateOrCreate(
                ['country_code' => $countryCode],
                ['currency_code' => $currencyCode]
            );
        }

        return count($currencies);
    }
    public function fetchCountryCurrencies()
    {
        $apiUrl = 'https://openexchangerates.org/api/currencies.json';
        $apiKey = '7d73c5a78e264889b3ae6980e8900ad1';

        $response = Http::get($apiUrl, [
            'prettyprint' => false,
            'show_alternative' => false,
            'show_inactive' => false,
            'app_id' => $apiKey,
        ]);

        return $response->json();
    }
}
