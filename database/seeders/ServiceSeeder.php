<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Service::query()->create([
            'name' => 'Pulmonolog maslahati',
            'price' => 50000
        ])->images()->create([
            'url' => env('APP_URL') . '/storage/services/sample-service.jpg'
        ]);

        Service::query()->create([
            'name' => 'Ftiziatr maslahati',
            'price' => 50000
        ])->images()->create([
            'url' => env('APP_URL') . '/storage/services/sample-service.jpg'
        ]);

        Service::query()->create([
            'name' => 'Raqamli ko‘chma mashinada flyurotekshiruv',
            'price' => 52000
        ])->images()->create([
            'url' => env('APP_URL') . '/storage/services/sample-service.jpg'
        ]);

        Service::query()->create([
            'name' => 'Raqamli rentgen tekshiruv (plenka bilan)',
            'price' => 59000
        ])->images()->create([
            'url' => env('APP_URL') . '/storage/services/sample-service.jpg'
        ]);

        Service::query()->create([
            'name' => 'Raqamli rentgen tekshiruv (plenkasiz)',
            'price' => 48000
        ])->images()->create([
            'url' => env('APP_URL') . '/storage/services/sample-service.jpg'
        ]);

        Service::query()->create([
            'name' => 'EKG',
            'price' => 40000
        ])->images()->create([
            'url' => env('APP_URL') . '/storage/services/sample-service.jpg'
        ]);

        Service::query()->create([
            'name' => 'Spirografiya (FVD)',
            'price' => 42000
        ])->images()->create([
            'url' => env('APP_URL') . '/storage/services/sample-service.jpg'
        ]);

        Service::query()->create([
            'name' => 'Balg‘am taxlili',
            'price' => 40000
        ])->images()->create([
            'url' => env('APP_URL') . '/storage/services/sample-service.jpg'
        ]);

        Service::query()->create([
            'name' => 'Umumiy Qon taxlili',
            'price' => 40000
        ])->images()->create([
            'url' => env('APP_URL') . '/storage/services/sample-service.jpg'
        ]);

        Service::query()->create([
            'name' => 'Siydik taxlili',
            'price' => 40000
        ])->images()->create([
            'url' => env('APP_URL') . '/storage/services/sample-service.jpg'
        ]);

        Service::query()->create([
            'name' => 'Ginekologik ajralma tahlili',
            'price' => 40000
        ])->images()->create([
            'url' => env('APP_URL') . '/storage/services/sample-service.jpg'
        ]);

        Service::query()->create([
            'name' => 'Tahlil uchun qon olish',
            'price' => 10000
        ])->images()->create([
            'url' => env('APP_URL') . '/storage/services/sample-service.jpg'
        ]);

        Service::query()->create([
            'name' => 'ALT aniqlash',
            'price' => 23000
        ])->images()->create([
            'url' => env('APP_URL') . '/storage/services/sample-service.jpg'
        ]);

        Service::query()->create([
            'name' => 'AST aniqlash',
            'price' => 23000
        ])->images()->create([
            'url' => env('APP_URL') . '/storage/services/sample-service.jpg'
        ]);

        Service::query()->create([
            'name' => 'Albumin aniqlash',
            'price' => 22000
        ])->images()->create([
            'url' => env('APP_URL') . '/storage/services/sample-service.jpg'
        ]);

        Service::query()->create([
            'name' => 'Bilirubin aniqlash',
            'price' => 22000
        ])->images()->create([
            'url' => env('APP_URL') . '/storage/services/sample-service.jpg'
        ]);

        Service::query()->create([
            'name' => 'Mochevina aniqlash',
            'price' => 23000
        ])->images()->create([
            'url' => env('APP_URL') . '/storage/services/sample-service.jpg'
        ]);

        Service::query()->create([
            'name' => 'Kreatinin aniqlash',
            'price' => 22000
        ])->images()->create([
            'url' => env('APP_URL') . '/storage/services/sample-service.jpg'
        ]);

        Service::query()->create([
            'name' => 'Glyukoza aniqlash',
            'price' => 25000
        ])->images()->create([
            'url' => env('APP_URL') . '/storage/services/sample-service.jpg'
        ]);

        Service::query()->create([
            'name' => 'Umumiy oqsilni aniqlash',
            'price' => 22000
        ])->images()->create([
            'url' => env('APP_URL') . '/storage/services/sample-service.jpg'
        ]);

        Service::query()->create([
            'name' => 'Kalsiy aniqlash',
            'price' => 24000
        ])->images()->create([
            'url' => env('APP_URL') . '/storage/services/sample-service.jpg'
        ]);

        Service::query()->create([
            'name' => 'Magniy aniqlash',
            'price' => 24000
        ])->images()->create([
            'url' => env('APP_URL') . '/storage/services/sample-service.jpg'
        ]);

        Service::query()->create([
            'name' => 'Kaliy aniqlash',
            'price' => 23000
        ])->images()->create([
            'url' => env('APP_URL') . '/storage/services/sample-service.jpg'
        ]);

        Service::query()->create([
            'name' => 'LDG aniqlsh',
            'price' => 27000
        ])->images()->create([
            'url' => env('APP_URL') . '/storage/services/sample-service.jpg'
        ]);

        Service::query()->create([
            'name' => 'Ma’lumotnoma berish',
            'price' => 23000
        ])->images()->create([
            'url' => env('APP_URL') . '/storage/services/sample-service.jpg'
        ]);
    }
}
