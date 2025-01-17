<?php

namespace App\Console\Commands;

use App\Models\Payment;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Storage;

class CreateJsonToSiteHook extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:create-json-to-site-hook';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Создает json файл для Вебхука';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $startDate = Carbon::create(2025, 1, 1)->startOfDay();
        $endDate = Carbon::create(2025, 1, 30)->endOfDay();
        $payments = Payment::whereBetween('created_at', [$startDate, $endDate])
            ->where('order_id', 'NOT LIKE', '%beauty%')
            ->get();
        $data = [];
        if(!$payments->isEmpty()) {
            foreach ($payments as $payment)
            {
                $incomeAmount = $payment->payment_sum - $payment->commission;
                $data[] = [
                    'type' => 'notification',
                    'event' => 'payment.succeeded',
                    'object' => [
                        'id' => $payment->payment_order_id,
                        'description' => $payment->order_id,
                        'amount' => [
                            'value' => (string)$payment->payment_sum,
                            'currency' => 'RUB'
                        ],
                        'income_amount' => [
                            'value' => (string)$incomeAmount,
                            'currency' => 'RUB'
                        ],
                    ]
                ];
            }
        }
        if($data)
        {
            Storage::put('public/json/import.json', json_encode($data, JSON_PRETTY_PRINT));
        }
        return 0;
    }
}
