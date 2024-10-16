<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function __invoke() {
        $user = User::find(session('user_id'));
        $pageTitle = 'Сводка платежей';
        $breadcrumbs = [
            [
                'name' => 'Главная',
                'link' => '/',
                'active' => false
            ],
            [
                'name' => 'Платежи',
                'link' => '/payments',
                'active' => true
            ],
        ];

        $payments = Payment::all();
        $formattedPayments = [];
        if(!$payments->isEmpty()) {
            foreach ($payments as $payment) {
                $siteInfo = $payment->site_info;
                $formattedPayments[] = [
                    'payment_date' => $payment->payment_time,
                    'payment_sum' => $payment->payment_sum,
                    'site' => $siteInfo->site_addr,
                    'order_id' => $payment->order_id,
                    'payment_id' => $payment->payment_order_id
                ];
            }
        }
        return view(
            'pages.Payment.payment',
            [
                'username' => $user->name,
                'page_title' => $pageTitle,
                'breadcrumbs' => $breadcrumbs,
                'block_title' => 'Платежи',
                'link' => '/payments',
                'payments' => $formattedPayments
            ]
        );
    }
}
