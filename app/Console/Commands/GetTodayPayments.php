<?php

namespace App\Console\Commands;

use App\Models\Payment;
use App\Models\Setting;
use Illuminate\Console\Command;

class GetTodayPayments extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:get-today-payments';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Запрашивает все платежи за сегодня';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $settings = Setting::all();
        if(!$settings->isEmpty()) {
            $limit = 100;
            $baseLink = sprintf(
                'https://api.yookassa.ru/v3/payments?limit=100&created_at.gte=%sT00:00:00.000Z',
                date('Y-m-d')
            );


            foreach ($settings as $setting) {
                $shopId = $setting->shop_id;
                $apiKey = $setting->api_key;
                $link = $baseLink;

                $normalizePayments = [];
                $cursorFlag = true;
                while ($cursorFlag) {
                    $payments = $this->getTodayPayments($shopId, $apiKey, $link);

                    if(isset($payments['items']) && count($payments['items']) > 0) {
                        foreach ($payments['items'] as $item) {
                            if($item['status'] != 'canceled') {
                                $dateStr = $item['created_at'];
                                $timeSec = strtotime($dateStr);
                                $timeSec += 180*60;
                                $date = date('Y-m-d H:i:s', $timeSec);
                                $totalSum = (float)$item['amount']['value'];
                                $incomeSum = (float)$item['income_amount']['value'];
                                $commission = $totalSum - $incomeSum;


                                $normalizePayments[] = [
                                    'site_id' => $setting->site_id,
                                    'payment_sum' => $item['amount']['value'],
                                    'payment_time' => $date,
                                    'order_id' => $item['description'],
                                    'payment_order_id' => $item['id'],
                                    'commission' => $commission
                                ];
                            }

                        }
                    }


                    if(isset($payments['next_cursor'])) {
                        $link = $baseLink.'&cursor='.$payments['next_cursor'];
                    } else {
                        $cursorFlag = false;
                    }
                }


                if($normalizePayments) {
                    foreach ($normalizePayments as $payment) {
                        $checkPay = Payment::where(['payment_order_id' => $payment['payment_order_id']])->first();
                        if(!$checkPay) {
                            Payment::create($payment);
                        }
                    }
                }
            }
        }
        return 'Данные получены';
    }

    private function getTodayPayments($shopId, $apiKey, $link): array {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $link);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($ch, CURLOPT_USERPWD, "$shopId:$apiKey");

        $response = curl_exec($ch);
        return json_decode($response, true);
    }
}
