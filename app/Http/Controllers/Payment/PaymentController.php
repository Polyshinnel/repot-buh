<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function __invoke(Request $request) {
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

        $dateStart = sprintf('%s-01 00:00:00', date('Y-m'));
        $dateEnd = sprintf('%s 23:59:59', date('Y-m-t'));

        $blockTitle = sprintf('Платежи с 01.%s по %s', date('m.Y'), date('t.m.Y'));

        $payments = Payment::whereBetween('payment_time', [$dateStart, $dateEnd])->orderBy('payment_time', 'DESC')->get();
        $formattedPayments = [];

        if(!$payments->isEmpty()) {
            foreach ($payments as $payment) {
                $siteInfo = $payment->site_info;
                $orderId = $payment->order_id;
                $orderArr = explode(' ', $orderId);
                $orderName = $orderArr[1];
                $link = 'Пусто';
                if(!str_contains($orderName, 'beauty')) {
                    $orderNum = preg_replace('/[^0-9]/', '', $orderName);
                    $link = sprintf('%s/panel/?module=OrderAdmin&id=%s', $siteInfo->site_addr, $orderNum);
                }

                $formattedPayments[] = [
                    'payment_date' => $payment->payment_time,
                    'payment_sum' => $payment->payment_sum,
                    'site' => $siteInfo->site_addr,
                    'order_id' => $payment->order_id,
                    'payment_id' => $payment->payment_order_id,
                    'commission' => $payment->commission,
                    'link' => $link
                ];
            }
        }
        return view(
            'pages.Payment.payment',
            [
                'username' => $user->name,
                'page_title' => $pageTitle,
                'breadcrumbs' => $breadcrumbs,
                'block_title' => $blockTitle,
                'link' => '/payments',
                'payments' => $formattedPayments
            ]
        );
    }
}
