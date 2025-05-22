<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class GeocodeSellers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:name';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
   // Run: php artisan make:command GeocodeSellers
// In app/Console/Commands/GeocodeSellers.php

public function handle()
{
    $apiKey = env('GOOGLE_MAP_KEY');
    $sellers = \App\Models\Seller::whereNull('latitude')->orWhereNull('longitude')->get();

    foreach ($sellers as $seller) {
        $address = implode(', ', array_filter([$seller->city, $seller->state, $seller->country]));
        if (!$address) continue;

        $response = Http::get('https://maps.googleapis.com/maps/api/geocode/json', [
            'address' => $address,
            'key' => $apiKey,
        ]);
        if ($response->successful() && isset($response['results'][0])) {
            $location = $response['results'][0]['geometry']['location'];
            $seller->latitude = $location['lat'];
            $seller->longitude = $location['lng'];
            $seller->save();
            $this->info("Geocoded: $seller->shop_name ($address)");
        }
        sleep(1); // To avoid hitting API limits
    }
}

}
