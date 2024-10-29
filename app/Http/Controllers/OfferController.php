<?php

namespace App\Http\Controllers;

use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Http;
use Illuminate\View\View;

class OfferController extends Controller
{
    public function index(): View
    {
        $token = 'eyJhbGciOiJSUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1c2VyX25hbWUiOiIxMDczOTQzODYiLCJzY29wZSI6WyJhbGxlZ3JvOmFwaTpvcmRlcnM6cmVhZCIsImFsbGVncm86YXBpOmZ1bGZpbGxtZW50OnJlYWQiLCJhbGxlZ3JvOmFwaTpwcm9maWxlOndyaXRlIiwiYWxsZWdybzphcGk6c2FsZTpvZmZlcnM6d3JpdGUiLCJhbGxlZ3JvOmFwaTpmdWxmaWxsbWVudDp3cml0ZSIsImFsbGVncm86YXBpOmJpbGxpbmc6cmVhZCIsImFsbGVncm86YXBpOmNhbXBhaWducyIsImFsbGVncm86YXBpOmRpc3B1dGVzIiwiYWxsZWdybzphcGk6c2FsZTpvZmZlcnM6cmVhZCIsImFsbGVncm86YXBpOnNoaXBtZW50czp3cml0ZSIsImFsbGVncm86YXBpOmJpZHMiLCJhbGxlZ3JvOmFwaTpvcmRlcnM6d3JpdGUiLCJhbGxlZ3JvOmFwaTphZHMiLCJhbGxlZ3JvOmFwaTpwYXltZW50czp3cml0ZSIsImFsbGVncm86YXBpOnNhbGU6c2V0dGluZ3M6d3JpdGUiLCJhbGxlZ3JvOmFwaTpwcm9maWxlOnJlYWQiLCJhbGxlZ3JvOmFwaTpyYXRpbmdzIiwiYWxsZWdybzphcGk6c2FsZTpzZXR0aW5nczpyZWFkIiwiYWxsZWdybzphcGk6cGF5bWVudHM6cmVhZCIsImFsbGVncm86YXBpOnNoaXBtZW50czpyZWFkIiwiYWxsZWdybzphcGk6bWVzc2FnaW5nIl0sImFsbGVncm9fYXBpIjp0cnVlLCJpc3MiOiJodHRwczovL2FsbGVncm8ucGwuYWxsZWdyb3NhbmRib3gucGwiLCJleHAiOjE3MzAyNzUyODksImp0aSI6Ijc0NTJjMDEyLWM2YWQtNDkxOC05NzAwLTI3MDA3MzY3YzJjMSIsImNsaWVudF9pZCI6IjhlOTdmYzllY2YwNjRiMWQ5NGEzZDBjN2FiMzk5ZTVhIn0.rQaixUDNS41gXRk2G27eQlfDv7JSc5PqqMdu37s7hocG2gxzNT_ekBzGj9OX4t7l1Fd20kCvPkhe5d9VNTnoNvgOb5YG1eaV0omSdt3HZ1S7IT_7dmdfxv6lIRyZoCB8yY1lcZLrty9T8MEcSoFOPdIBD0pBFH4QITzWvonJX32EZbq3GwlR8RHxGi6H2fqC4RIOYC9PmYwAiZDR6X_mRS5LRmCXfIHEiinUJT1jU6YspqV94GdiJ1IusfkTr9zLcyAOlAsh5Tp36r7WU67b08VqkvbxV85xrsXzqX5EJuaE2g2BAdDAZUM05UiHElhpQR2vAJPh-tNORV73W7qz0IG_jyER_DqXN2-dwVYA8nZB8BnL034EO0a4fBb0YAZOFlvKwdNrbpNnjWJBjJwTMwPkZKegZo83TxAsQ_Q7-GkmQB4WbpZLFDx04yjCqZ6KDSzxqn_jO45p3w6MXPbZVPQYmsciRjjkvybKnHZ8r9kYGwqyzeRR-880O2gyTY3m7zizXyr_r2Zuw0MY4fz6j7mfmRg5aN9j12ZkBtsa9ivGXCN8ErC05E25icZI8G3R_-UFfQ74JbQMD2p2yCTGvuxEGJSebcECCcmI0MjiKgX9XiafTQyiju_0PnYpdlqcLQYUu59Tvo3ZgxZLE1zqYU2xFsL9J1NsjEw5evzLZfY'; // Replace with actual token

        try {
            $response = Http::withToken($token)
                ->withHeaders([
                    'Accept' => 'application/vnd.allegro.public.v1+json',
                ])
                ->get('https://api.allegro.pl.allegrosandbox.pl/sale/offers');

            $offers = $response->json()['offers'] ?? [];

            return view('offers.index', compact('offers'));
        } catch (RequestException $e) {
            // Handle the exception (e.g., log the error, display a message)
            return view('offers.index', ['offers' => [], 'error' => 'Could not fetch offers.']);
        }
    }
}

