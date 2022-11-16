<?php

namespace App\Http\Controllers;

use App\Models\Shortened;
use App\Models\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ShortenedController extends Controller
{
    public function show(Shortened $shortened)
    {

        $ip = "8.40.11.89";
        $ipInfo = Http::get("http://ip-api.com/json/{$ip}")->object();

        View::create([
            'country' => $ipInfo->country,
            'visited_at' => now(),
            'shortened_id' => $shortened->id
        ]);

        return redirect($shortened->url);
    }
}
