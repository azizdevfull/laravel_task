<?php

namespace App\Http\Controllers;

use App\Models\CountryCurrency;
use App\Services\CurrencyIntegrationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CurrencyController extends Controller
{
    public function syncCurrencies()
    {
        $currencyService = new CurrencyIntegrationService();
        $count = $currencyService->fetchCountryCurrenciesAndStore();

        return "Synced $count country currencies.";
    }
}
