<?php

namespace App\Http\Controllers\Returning;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Returning;
use App\Models\Setting;
use Illuminate\Http\Request;

class GetReturning extends Controller
{
    public function __invoke()
    {
        $settings = Setting::all();
        if(!$settings->isEmpty()) {
            foreach ($settings as $setting) {
                $shopId = $setting->shop_id;
                $apiKey = $setting->api_key;
                $baseLink = 'https://api.yookassa.ru/v3/refunds?limit=100&created_at.gte=2024-10-22T00:00:00.139Z';
                $link = $baseLink;


                $normalizePayments = [];
                $cursorFlag = true;
                while ($cursorFlag) {
                    $returnings = $this->getTodayReturning($shopId, $apiKey, $link);
                    if(isset($returnings['items']) && count($returnings['items']) > 0) {
                        foreach ($returnings['items'] as $item) {

                            $dateStr = $item['created_at'];
                            $timeSec = strtotime($dateStr);
                            $timeSec += 180*60;
                            $date = date('Y-m-d H:i:s', $timeSec);
                            $totalSum = (float)$item['amount']['value'];

                            $paymentId = $item['payment_id'];
                            $payment = Payment::where(['payment_order_id' => $paymentId])->first();

                            if($payment) {
                                $payment->update(['status_payment' => 2]);
                                $normalizePayments[] = [
                                    'site_id' => $setting->site_id,
                                    'payment_sum' => $item['amount']['value'],
                                    'payment_time' => $date,
                                    'order_id' => $payment->order_id,
                                    'payment_order_id' => $paymentId,
                                ];
                            }
                        }
                    }


                    if(isset($returnings['next_cursor'])) {
                        $link = $baseLink.'&cursor='.$returnings['next_cursor'];
                    } else {
                        $cursorFlag = false;
                    }
                }


                if($normalizePayments) {
                    foreach ($normalizePayments as $returning) {
                        $checkPay = Returning::where(['payment_order_id' => $returning['payment_order_id']])->first();
                        if(!$checkPay) {
                            Returning::create($returning);
                        }
                    }
                }
            }
        }

        return response()->json(['message' => 'scan is ok']);

    }

    private function getTodayReturning($shopId, $apiKey, $link): array {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $link);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($ch, CURLOPT_USERPWD, "$shopId:$apiKey");

        $response = curl_exec($ch);
        return json_decode($response, true);
    }
}
