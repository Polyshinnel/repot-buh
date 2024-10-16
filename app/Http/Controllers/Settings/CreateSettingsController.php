<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Models\PaymentSystem;
use App\Models\Site;
use App\Models\User;
use Illuminate\Http\Request;

class CreateSettingsController extends Controller
{
    public function __invoke() {
        $user = User::find(session('user_id'));
        $paymentSystems = PaymentSystem::all();
        $sites = Site::all();
        $pageTitle = 'Добавление сайта';
        $breadcrumbs = [
            [
                'name' => 'Главная',
                'link' => '/',
                'active' => false
            ],
            [
                'name' => 'Настройки',
                'link' => '/settings',
                'active' => false
            ],
            [
                'name' => 'Добавление сайта',
                'link' => '/settings/add',
                'active' => true
            ],
        ];
        return view(
            'pages.Settings.settings-add',
            [
                'username' => $user->name,
                'page_title' => $pageTitle,
                'breadcrumbs' => $breadcrumbs,
                'block_title' => 'Добавление сайта',
                'link' => '/settings/add',
                'sites' => $sites,
                'payment' => $paymentSystems
            ]
        );
    }
}
