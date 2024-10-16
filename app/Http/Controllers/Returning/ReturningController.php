<?php

namespace App\Http\Controllers\Returning;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ReturningController extends Controller
{
    public function __invoke()
    {
        $user = User::find(session('user_id'));
        $pageTitle = 'Сводка возвратов';
        $breadcrumbs = [
            [
                'name' => 'Главная',
                'link' => '/',
                'active' => false
            ],
            [
                'name' => 'Возвраты',
                'link' => '/returning',
                'active' => true
            ],
        ];
        return view(
            'pages.Returning.returning',
            [
                'username' => $user->name,
                'page_title' => $pageTitle,
                'breadcrumbs' => $breadcrumbs,
                'block_title' => 'Возвраты',
                'link' => '/returning'
            ]
        );
    }
}
