<?php


namespace App\Services;

use Illuminate\Support\Facades\Http;

class AllegroService
{
    const CLIENT_ID = '8f85a7a8ffe543188af9f7f316b15fa7'; // wprowadź Client_ID aplikacji
    const CLIENT_SECRET = '5SZ0R1lNMwTQ0BnFR80oTdnfmIhIJXwQUIxeh11Yl2WiQzN7jtNqK6otOGHQjSny'; // wprowadź Client_Secret aplikacji

    public function getAccessToken()
    {
        $authorization = base64_encode(self::CLIENT_ID . ':' . self::CLIENT_SECRET);
        $response = Http::withHeaders([
            'Authorization' => 'Basic ' . $authorization,
            'Content-Type' => 'application/x-www-form-urlencoded',
        ])->post('https://allegro.pl.allegrosandbox.pl/auth/oauth/token', [
            'grant_type' => 'client_credentials',
        ]);

        if ($response->failed()) {
            throw new \Exception('Something went wrong while retrieving access token');
        }

        return $response->json()['access_token'];
    }
}
