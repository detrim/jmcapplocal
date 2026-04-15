<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class SyncWilayah extends Command
{
    protected $signature = 'app:sync-wilayah';
    protected $description = 'Sync data wilayah ke storage';

    public function handle()
    {
        set_time_limit(0);
        ini_set('memory_limit', '512M');

        $result = [
            'provinsi' => [],
            'kabupaten' => [],
            'kecamatan' => [],
        ];

        // 1. PROVINSI
        $provinsi = Http::retry(3, 200)
            ->timeout(60)
            ->connectTimeout(20)
            ->withoutVerifying()
            ->get('https://www.wilayah.id/api/provinces.json')
            ->json('data') ?? [];
        $result['provinsi'] = $provinsi;

        foreach ($provinsi as $prov) {

            // 2. KABUPATEN
            $kabupaten = Http::retry(3, 200)
                ->timeout(60)
                ->connectTimeout(20)
                ->withoutVerifying()
                ->get("https://www.wilayah.id/api/regencies/{$prov['code']}.json")
                ->json('data') ?? [];

            foreach ($kabupaten as $kab) {

                $result['kabupaten'][] = [
                    'code' => $kab['code'],
                    'name' => $kab['name'],
                    'province_code' => $prov['code'],
                    'province_name' => $prov['name'],
                ];

                // 3. KECAMATAN
                $kecamatan = Http::retry(3, 200)
                    ->timeout(60)
                    ->connectTimeout(20)
                    ->withoutVerifying()
                    ->get("https://www.wilayah.id/api/districts/{$kab['code']}.json")
                    ->json('data') ?? [];

                foreach ($kecamatan as $kec) {
                    $result['kecamatan'][] = [
                        'code' => $kec['code'],
                        'name' => $kec['name'],
                        'regency_id' => $kab['code'],
                        'regency_name' => $kab['name'],
                        'province_code' => $prov['code'],
                        'province_name' => $prov['name'],
                    ];
                }
            }
        }

        Storage::put('wilayah.json', json_encode($result));

        $this->info('Sync wilayah selesai');
    }
}
