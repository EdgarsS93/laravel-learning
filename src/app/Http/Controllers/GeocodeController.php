<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class GeocodeController extends Controller
{
    public function geocode(Request $request): array
    {
        $address = $request->input('address');
        $accessToken = config('services.mapbox.key');

        $response = Http::get('https://api.mapbox.com/geocoding/v5/mapbox.places/' . rawurlencode($address) . '.json', [
            'access_token' => $accessToken,
            'limit' => 1,
        ]);

        return $response->json();
    }
}
