<?php

namespace Database\Seeders;

use App\Models\SocialMedia;
use Illuminate\Database\Seeder;

class SocialMediaSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'platform' => 'facebook',
                'name' => 'Facebook',
                'url' => 'https://facebook.com/smkmultikarya',
                'icon' => 'f',
                'order' => 1,
                'is_active' => true
            ],
            [
                'platform' => 'instagram',
                'name' => 'Instagram',
                'url' => 'https://instagram.com/smkmultikarya',
                'icon' => '',
                'order' => 2,
                'is_active' => true
            ],
            [
                'platform' => 'youtube',
                'name' => 'YouTube',
                'url' => 'https://youtube.com/smkmultikarya',
                'icon' => '▶',
                'order' => 3,
                'is_active' => true
            ],
        ];

        foreach ($data as $item) {
            SocialMedia::create($item);
        }
    }
}