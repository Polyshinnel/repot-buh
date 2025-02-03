<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function __invoke() {
        $user = User::find(session('user_id'));
        $pageTitle = 'Настройки';
        $breadcrumbs = [
            [
                'name' => 'Главная',
                'link' => '/',
                'active' => false
            ],
            [
                'name' => 'Настройки',
                'link' => '/settings',
                'active' => true
            ],
        ];

        $settingsList = [];
        $settings = Setting::all();
        if(!$settings->isEmpty()) {
            foreach ($settings as $setting) {
                $siteInfo = $setting->site_info;
                $payment = $setting->payment_info;
                $settingsList[] = [
                    'id' => $setting->id,
                    'site_addr' => $siteInfo->site_addr,
                    'payment' => $payment->payment_name,
                    'shop_id' => $setting->shop_id,
                    'api_key' => $setting->api_key,
                    'database' => $setting->database,
                    'prefix' => $setting->prefix
                ];
            }
        }

        return view(
            'pages.Settings.settings',
            [
                'username' => $user->name,
                'page_title' => $pageTitle,
                'breadcrumbs' => $breadcrumbs,
                'block_title' => 'Настройки',
                'link' => '/settings',
                'settings_list' => $settingsList
            ]
        );
    }
}
