<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __invoke()
    {
        $user = User::find(session('user_id'));
        $pageTitle = 'Дашборд';
        $breadcrumbs = [
            [
                'name' => 'Главная',
                'link' => '/',
                'active' => true
            ]
        ];
        return view('home', ['username' => $user->name, 'page_title' => $pageTitle, 'breadcrumbs' => $breadcrumbs, 'block_title' => 'Активность']);
    }
}
