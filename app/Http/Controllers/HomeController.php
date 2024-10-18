<?php

namespace App\Http\Controllers;

use App\Models\Payment;
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

        $date = date('Y-m-d');
        $selectDate = $date.' '.'00:00:00';
        $filter = [
            ['payment_time', '>=', $selectDate]
        ];
        $payments = Payment::where($filter)->get();
        $paymentCount = $payments->count();
        $paymentSum = 0;

        $formattedPayment = [];
        $formattedPayment['items'] = [];
        if($paymentCount > 0) {
            foreach ($payments as $payment) {
                $siteData = $payment->site_info;
                $siteAddr = $siteData->site_addr;
                $paymentSum += (float)$payment->payment_sum;
                $formattedPayment['items'][] = [
                    'site' => $siteAddr,
                    'sum' => $payment->payment_sum,
                    'date' => $payment->payment_time,
                    'order_id' => $payment->order_id
                ];
            }
        }

        $formattedPayment['payment_count'] = $paymentCount;
        $formattedPayment['payment_sum'] = $paymentSum;

        return view(
            'home',
            [
                'username' => $user->name,
                'page_title' => $pageTitle,
                'breadcrumbs' => $breadcrumbs,
                'block_title' => 'Активность',
                'link' => '/',
                'payments' => $formattedPayment,
                'today' => date('d.m.Y')
            ]
        );
    }
}
