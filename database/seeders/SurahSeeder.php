<?php

namespace Database\Seeders;

use App\Models\Ayah;
use App\Models\Surah;
use App\Models\Tafsir;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;

class SurahSeeder extends Seeder
{
    public function run(): void
{
    $response = Http::get('https://api.alquran.cloud/v1/quran/ar.alafasy');
    $baseUrl = 'https://server8.mp3quran.net/afs/';
    $tafsirId = 1;

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

        foreach ($surahData['ayahs'] as $ayahData) {

            $ayah = Ayah::firstOrCreate(
                [
                    'surah_id' => $surah->id,
                    'number' => $ayahData['number'],
                ],
                [
                    'number_in_surah' => $ayahData['numberInSurah'],
                    'ayah' => $ayahData['text'],
                    'juz' => $ayahData['juz'],
                    'page' => $ayahData['page'],
                    'hizb_quarter' => $ayahData['hizbQuarter'],
                    'sajda' => is_array($ayahData['sajda']) ? true : false,
                    'audio_128' => $ayahData['audio'],
                ]
            );

            $tafseerUrl = "http://api.quran-tafseer.com/tafseer/{$tafsirId}/{$surahData['number']}/{$ayahData['numberInSurah']}";

            $tafseerResponse = Http::get($tafseerUrl);

            if ($tafseerResponse->successful()) {
                $tafseerText = $tafseerResponse->json('text');

                Tafsir::firstOrCreate(
                    [
                        'ayah_id' => $ayah->id,
                        'tafsir_id' => $tafsirId,
                    ],
                    [
                        'text' => $tafseerText,
                    ]
                );
            }
        }
    }
}

}
