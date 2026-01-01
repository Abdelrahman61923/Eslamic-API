<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use App\Models\Surah;
use App\Models\Ayah;

class SurahSeeder extends Seeder
{
    public function run(): void
    {
        $response = Http::get('https://api.alquran.cloud/v1/quran/ar.alafasy');
        $baseUrl = 'https://server8.mp3quran.net/afs/';

        if (!$response->successful()) {
            return;
        }

        $surahs = $response->json('data.surahs');

        foreach ($surahs as $index => $surahData) {

            $number = str_pad($index + 1, 3, '0', STR_PAD_LEFT);
            $surah = Surah::firstOrCreate(
                ['number' => $surahData['number']],
                [
                    'name' => $surahData['name'],
                    'url' => $baseUrl . $number . '.mp3',
                    'revelation_type' => $surahData['revelationType'],
                ]
            );

            foreach ($surahData['ayahs'] as $ayah) {
                Ayah::firstOrCreate(
                    [
                        'surah_id' => $surah->id,
                        'number' => $ayah['number'],
                    ],
                    [
                        'number_in_surah' => $ayah['numberInSurah'],
                        'ayah' => $ayah['text'],
                        'juz' => $ayah['juz'],
                        'page' => $ayah['page'],
                        'hizb_quarter' => $ayah['hizbQuarter'],
                        'sajda' => is_array($ayah['sajda']) ? true : false,
                        'audio_128' => $ayah['audio'],
                    ]
                );
            }
        }
    }
}
