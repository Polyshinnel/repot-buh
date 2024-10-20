<?php

namespace App\Http\Controllers\Returning;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Utils\TimeController;
use App\Models\Payment;
use App\Models\Returning;
use App\Models\User;
use Illuminate\Http\Request;

class ReturningController extends Controller
{
    public function __invoke(Request $request)
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
                ['payment_time', '>=', $selectDate]
            ];
            $returnings = Returning::where($filter)->orderBy('payment_time', 'DESC')->get();
            $blockTitle = 'Возвраты за сегодня';
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

            $returnings = Returning::whereBetween('payment_time', [$yesterdayDateStart, $yesterdayDateEnd])->orderBy('payment_time', 'DESC')->get();
            $blockTitle = 'Возвраты за вчера';
        }

        if($dateInfo == 'interval') {
            $timeController = new TimeController();
            $blockTitle = 'Возвраты ';
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
                    ['payment_time', '<=', $dateEnd]
                ];
                $returnings = Returning::where($filter)->orderBy('payment_time', 'DESC')->get();
                $blockTitle .= 'по '. $dateEnd;
            }

            //Если пуста дата конца
            if($dateStart != '' && $dateEnd == '') {
                $filter = [
                    ['payment_time', '>=', $dateStart]
                ];
                $returnings = Returning::where($filter)->orderBy('payment_time', 'DESC')->get();
                $blockTitle .= 'c '. $dateStart;
            }

            //Если получен интервал
            if($dateStart != '' && $dateEnd != '') {
                $returnings = Returning::whereBetween('payment_time', [$dateStart, $dateEnd])->orderBy('payment_time', 'DESC')->get();
                $blockTitle .= 'c '. $dateStart.' по '.$dateEnd;
            }
        }

        //Фильтр по умолчанию
        if($dateInfo == 'month') {
            $dateStart = sprintf('%s-01 00:00:00', date('Y-m'));
            $dateEnd = sprintf('%s 23:59:59', date('Y-m-t'));

            $returnings = Returning::whereBetween('payment_time', [$dateStart, $dateEnd])->orderBy('payment_time', 'DESC')->get();
            $blockTitle = sprintf('Возвраты с 01.%s по %s', date('m.Y'), date('t.m.Y'));
        }




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
            'pages.Returning.returning',
            [
                'username' => $user->name,
                'page_title' => $pageTitle,
                'breadcrumbs' => $breadcrumbs,
                'block_title' => $blockTitle,
                'link' => '/returning',
                'returnings' => $formattedReturnings,
                'returning_count' => $returningCount,
                'returning_sum' => number_format($returningSum, 2, '.', ' ')
            ]
        );
    }
}
