<?php

namespace App\Services;

use App\Models\Setting;

class SettingsService
{
    public function getRecieptSettings($prefix): ?string
    {
        $settings = Setting::where('prefix', $prefix)->first();
        return $settings?->database;
    }
}
