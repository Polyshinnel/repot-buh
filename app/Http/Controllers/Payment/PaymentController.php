<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Utils\TimeController;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function __invoke(Request $request) {
        date_default_timezone_set('Europe/Moscow');
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

        $dateInfo = 'month';
        if($request->query('date_info')) {
            $dateInfo = $request->query('date_info');
        }

        $blockTitle = '';

        //Фильтр сегодня
        if($dateInfo == 'today') {
            $date = date('Y-m-d');
            $selectDate = $date.' '.'00:00:00';
            $filter = [
                ['payment_time', '>=', $selectDate],
                ['status_payment', '=', 1]
            ];
            $payments = Payment::where($filter)->orderBy('payment_time', 'DESC')->get();
            $blockTitle = 'Платежи за сегодня';
        }

        //Фильтр вчера
        if($dateInfo == 'yesterday') {
            $date = date('Y-m-d');
            $selectDate = $date.' '.'00:00:00';
            $selectedDateSec = strtotime($selectDate);
            $yesterday = $selectedDateSec - (24 * 3600);
            $yesterdayDate = date('Y-m-d', $yesterday);
            $yesterdayDateStart = sprintf('%s 00:00:00', $yesterdayDate);
            $yesterdayDateEnd = sprintf('%s 23:59:59', $yesterdayDate);

            $payments = Payment::where(['status_payment' => 1])->whereBetween('payment_time', [$yesterdayDateStart, $yesterdayDateEnd])->orderBy('payment_time', 'DESC')->get();
            $blockTitle = 'Платежи за вчера';
        }

        if($dateInfo == 'interval') {
            $timeController = new TimeController();
            $blockTitle = 'Платежи ';
            $dateStart = '';
            if($request->query('date_start')) {
                $dateStart = $request->query('date_start');
                $dateStart = $timeController->reformatDate($dateStart, 'en');
                $dateStart = sprintf('%s 00:00:00', $dateStart);
            }

            $dateEnd = '';
            if($request->query('date_end')) {
                $dateEnd = $request->query('date_end');
                $dateEnd = $timeController->reformatDate($dateEnd, 'en');
                $dateEnd = sprintf('%s 23:59:59', $dateEnd);
            }

            //Если пуста дата начала
            if($dateStart == '' && $dateEnd != '') {
                $filter = [
                    ['payment_time', '<=', $dateEnd],
                    ['status_payment', '=', 1]
                ];
                $payments = Payment::where($filter)->orderBy('payment_time', 'DESC')->get();
                $blockTitle .= 'по '. $dateEnd;
            }

            //Если пуста дата конца
            if($dateStart != '' && $dateEnd == '') {
                $filter = [
                    ['payment_time', '>=', $dateStart],
                    ['status_payment', '=', 1]
                ];
                $payments = Payment::where($filter)->orderBy('payment_time', 'DESC')->get();
                $blockTitle .= 'c '. $dateStart;
            }

            //Если получен интервал
            if($dateStart != '' && $dateEnd != '') {
                $payments = Payment::where(['status_payment' => 1])->whereBetween('payment_time', [$dateStart, $dateEnd])->orderBy('payment_time', 'DESC')->get();
                $blockTitle .= 'c '. $dateStart.' по '.$dateEnd;
            }
        }

        //Фильтр по умолчанию
        if($dateInfo == 'month') {
            $dateStart = sprintf('%s-01 00:00:00', date('Y-m'));
            $dateEnd = sprintf('%s 23:59:59', date('Y-m-t'));

            $payments = Payment::where(['status_payment' => 1])->whereBetween('payment_time', [$dateStart, $dateEnd])->orderBy('payment_time', 'DESC')->get();
            $blockTitle = sprintf('Платежи с 01.%s по %s', date('m.Y'), date('t.m.Y'));
        }




        $formattedPayments = [];
        $paymentCount = 0;
        $paymentSum = 0;

        if(!$payments->isEmpty()) {
            $timeController = new TimeController();
            foreach ($payments as $payment) {
                $siteInfo = $payment->site_info;
                $orderId = $payment->order_id;
                $orderArr = explode(' ', $orderId);
                $orderName = $orderArr[1];
                $link = 'Пусто';
                $paymentCount++;
                $paymentSum += $payment->payment_sum;
                if(!str_contains($orderName, 'beauty')) {
                    $orderNum = preg_replace('/[^0-9]/', '', $orderName);
                    $link = sprintf('%s/panel/?module=OrderAdmin&id=%s', $siteInfo->site_addr, $orderNum);
                }

                $paymentDate = $timeController->reformatDateTime($payment->payment_time);

                $formattedPayments[] = [
                    'payment_date' => $paymentDate['formatted_date'],
                    'payment_sum' => number_format($payment->payment_sum, 2, '.', ' '). '₽',
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
                'payments' => $formattedPayments,
                'payment_count' => $paymentCount,
                'payment_sum' => number_format($paymentSum, 2, '.', ' ')
            ]
        );
    }
}
