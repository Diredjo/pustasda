<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AppSetting;

class AppSettingSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            ['key' => 'app_name', 'value' => 'PUSTASDA', 'group' => 'general'],
            ['key' => 'app_logo', 'value' => 'logo-pustasda.png', 'group' => 'general'],
            ['key' => 'app_tagline', 'value' => 'Pusat Prestasi SMK Telkom Sidoarjo', 'group' => 'general'],
            ['key' => 'theme_primary', 'value' => '#e31e25', 'group' => 'theme'],
            ['key' => 'theme_secondary', 'value' => '#f5a623', 'group' => 'theme'],
            ['key' => 'theme_dark', 'value' => '#2d2d2d', 'group' => 'theme'],
            ['key' => 'theme_light', 'value' => '#f8f9fa', 'group' => 'theme'],
            ['key' => 'wa_api_key', 'value' => '', 'group' => 'api'],
            ['key' => 'claude_api_key', 'value' => '', 'group' => 'api'],
            ['key' => 'pusher_app_id', 'value' => '', 'group' => 'api'],
        ];

        foreach ($settings as $setting) {
            AppSetting::create($setting);
        }
    }
}