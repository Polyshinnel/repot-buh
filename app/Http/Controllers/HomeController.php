<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Utils\TimeController;
use App\Models\Payment;
use App\Models\Returning;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __invoke()
    {
        date_default_timezone_set('Europe/Moscow');
        $user = User::find(session('user_id'));
        $pageTitle = 'Дашборд';
        $breadcrumbs = [
            [
                'name' => 'Главная',
                'link' => '/',
                'active' => true
            ]
        ];

        //Платежи за сегодня
        $date = date('Y-m-d');
        $selectDate = $date.' '.'00:00:00';
        $filter = [
            ['payment_time', '>=', $selectDate]
        ];
        $payments = Payment::where($filter)->orderBy('payment_time', 'ASC')->get();
        $paymentCount = $payments->count();
        $paymentSum = 0;

        //Платежи за вчера
        $selectedDateSec = strtotime($selectDate);
        $yesterday = $selectedDateSec - (24 * 3600);
        $yesterdayDate = date('Y-m-d', $yesterday);
        $yesterdayDateStart = sprintf('%s 00:00:00', $yesterdayDate);
        $yesterdayDateEnd = sprintf('%s 23:59:59', $yesterdayDate);

        $yesterday_payments = Payment::whereBetween('payment_time', [$yesterdayDateStart, $yesterdayDateEnd])->orderBy('payment_time', 'DESC')->get();

        $formattedPayment = [];
        $formattedPayment['items'] = [];
        if($paymentCount > 0) {
            $timeController = new TimeController();
            foreach ($payments as $payment) {
                $siteData = $payment->site_info;
                $siteAddr = $siteData->site_addr;
                $paymentSum += (float)$payment->payment_sum;

                $orderId = $payment->order_id;
                $orderArr = explode(' ', $orderId);
                $orderName = $orderArr[1];
                $link = 'Пусто';
                if(!str_contains($orderName, 'beauty')) {
                    $orderNum = preg_replace('/[^0-9]/', '', $orderName);
                    $link = sprintf('%s/panel/?module=OrderAdmin&id=%s', $siteData->site_addr, $orderNum);
                }

                $datePayment = $timeController->reformatDateTime($payment->payment_time);


                $formattedPayment['items'][] = [
                    'site' => $siteAddr,
                    'sum' => number_format($payment->payment_sum, 2, '.', ' '),
                    'date' => $datePayment['formatted_date'],
                    'order_id' => $payment->order_id,
                    'link' => $link
                ];
            }
        }

        $yesterdaySum = 0;

        if(!$yesterday_payments->isEmpty()) {
            foreach ($yesterday_payments as $payment) {
                $yesterdaySum += $payment->payment_sum;
            }
        }

        $paymentPercent = (($paymentSum - $yesterdaySum) / $paymentSum) * 100;
        $paymentPercent = number_format($paymentPercent, 1, '.', ' ');

        $formattedPayment['payment_count'] = $paymentCount;
        $formattedPayment['payment_sum'] = $paymentSum;

        $plotData = [];
        if($formattedPayment['items']) {
            $plotData = $this->getPlotData($formattedPayment['items']);
        }

        $dateStart = sprintf('%s-01 00:00:00', date('Y-m'));
        $dateEnd = sprintf('%s 23:59:59', date('Y-m-t'));

        $returnings = Returning::whereBetween('payment_time', [$dateStart, $dateEnd])->orderBy('payment_time', 'DESC')->get();
        $blockTitle = sprintf('Возвраты с 01.%s по %s', date('m.Y'), date('t.m.Y'));

        $formattedReturnings = [];
        $returningCount = 0;
        $returningSum = 0;

        if(!$returnings->isEmpty()) {
            $timeController = new TimeController();
            foreach ($returnings as $returning) {
                $siteInfo = $returning->site_info;
                $orderId = $returning->order_id;
                $orderArr = explode(' ', $orderId);
                $orderName = $orderArr[1];
                $link = 'Пусто';
                if(!str_contains($orderName, 'beauty')) {
                    $orderNum = preg_replace('/[^0-9]/', '', $orderName);
                    $link = sprintf('%s/panel/?module=OrderAdmin&id=%s', $siteInfo->site_addr, $orderNum);
                }

                $returningCount++;
                $returningSum += $returning->payment_sum;
                $returningDate = $timeController->reformatDateTime($returning->payment_time);


                $formattedReturnings[] = [
                    'payment_date' => $returningDate['formatted_date'],
                    'payment_sum' => number_format($returning->payment_sum, 2, '.', ' '),
                    'site' => $siteInfo->site_addr,
                    'order_id' => $returning->order_id,
                    'payment_id' => $returning->payment_order_id,
                    'link' => $link
                ];
            }
        }

        return view(
            'home',
            [
                'username' => $user->name,
                'page_title' => $pageTitle,
                'breadcrumbs' => $breadcrumbs,
                'block_title' => 'Активность',
                'link' => '/',
                'payments' => $formattedPayment,
                'today' => date('d.m.Y'),
                'plot_data' => $plotData,
                'payment_percent' => $paymentPercent,
                'returnings' => $formattedReturnings
            ]
        );
    }

    /**
     * @param array $payments
     * @return array{data_payment: array, data_axis: array}
     */
    private function getPlotData(array $payments): array {
        $sitesPayment = [];
        $axisPayment = [];
        $timeController = new TimeController();

        foreach ($payments as $payment) {
            $dateArr = explode(' ', $payment['date']);
            $axisPayment[] = $dateArr[1];
            $sitesPayment[] = $payment['sum'];
        }

        return [
            'data_payment' => $sitesPayment,
            'data_axis' => $axisPayment
        ];
    }
}
