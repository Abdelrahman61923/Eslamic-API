<?php

namespace Database\Seeders;

use App\Models\Radio;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RadioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $radios = [
            ['name' => 'إذاعة القرأن الكريم من القاهرة', 'url' => 'https://n0e.radiojar.com/8s5u5tpdtwzuv?rj-ttl=5&rj-tok=AAABjW7yROAA0TUU8cXhXIAi6g'],
            ['name' => 'إذاعة عبدالباسط عبدالصمد', 'url' => 'https://backup.qurango.net/radio/abdulbasit_abdulsamad_mojawwad'],
            ['name' => 'إذاعة محمود خليل الحصري', 'url' => 'https://backup.qurango.net/radio/mahmoud_khalil_alhussary'],
            ['name' => 'إذاعة محمود علي البنا', 'url' => 'https://backup.qurango.net/radio/mahmoud_ali__albanna'],
            ['name' => 'ذاعة محمد صديق المنشاوي', 'url' => 'https://backup.qurango.net/radio/mohammed_siddiq_alminshawi'],
            ['name' => 'إذاعة ماهر المعيقلي', 'url' => 'https://backup.qurango.net/radio/maher'],
            ['name' => 'ذاعة ناصر القطامي', 'url' => 'https://backup.qurango.net/radio/nasser_alqatami'],
            ['name' => 'إذاعة إبراهيم الأخضر', 'url' => 'https://backup.qurango.net/radio/ibrahim_alakdar'],
            ['name' => 'إذاعة شيخ أبو بكر الشاطري', 'url' => 'https://backup.qurango.net/radio/shaik_abu_bakr_al_shatri'],
            ['name' => 'إذاعة أحمد العجمي', 'url' => 'https://backup.qurango.net/radio/ahmad_alajmy'],
            ['name' => 'إذاعة أحمد الحواشي', 'url' => 'https://backup.qurango.net/radio/ahmad_alhawashi'],
            ['name' => 'إذاعة أحمد صابر', 'url' => 'https://backup.qurango.net/radio/ahmad_saber'],
            ['name' => 'إذاعة تكبيرات العيد', 'url' => 'https://backup.qurango.net/radio/eid'],
        ];

        foreach ($radios as $radio) {
            Radio::firstOrCreate(
                ['url' => $radio['url']],
                ['name' => $radio['name']]
            );
        }
    }
}

