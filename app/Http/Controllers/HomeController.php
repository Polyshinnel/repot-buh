<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Utils\TimeController;
use App\Models\Payment;
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

        $date = date('Y-m-d');
        $selectDate = $date.' '.'00:00:00';
        $filter = [
            ['payment_time', '>=', $selectDate]
        ];
        $payments = Payment::where($filter)->orderBy('payment_time', 'ASC')->get();
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

        $plotData = [];
        if($formattedPayment['items']) {
            $plotData = $this->getPlotData($formattedPayment['items']);
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
                'plot_data' => $plotData
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
            $date = $timeController->reformatDateTime($payment['date']);
            $axisPayment[] = $date['time'];
            $sitesPayment[] = $payment['sum'];
        }

        return [
            'data_payment' => $sitesPayment,
            'data_axis' => $axisPayment
        ];
    }
}
