<?php

namespace App\Service;

use Illuminate\Support\Facades\Http;

class CurrencyIntegrationService
{
    public function fetchCountryCurrencies()
    {
        $apiUrl = 'https://openexchangerates.org/api/currencies.json';
        $apiKey = '7d73c5a78e264889b3ae6980e8900ad1'; // Replace with your API key

        $response = Http::get($apiUrl, [
            'prettyprint' => false,
            'show_alternative' => false,
            'show_inactive' => false,
            'app_id' => $apiKey,
        ]);

        return $response->json();
    }
}
