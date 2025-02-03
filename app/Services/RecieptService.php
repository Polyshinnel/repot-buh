<?php

namespace App\Services;

use App\Models\Reciept;
use App\Models\RecieptPurchase;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class RecieptService
{
    public function getReciepts(): array
    {
        $formattedReciepts = [];
        $reciepts = Reciept::all();
        if(!$reciepts->isEmpty())
        {
            foreach ($reciepts as $reciept)
            {
                $formattedReciepts[] = [
                    'id' => $reciept->id,
                    'name' => $reciept->name,
                    'customer' => $reciept->customer,
                    'email' => $reciept->email,
                    'phone' => $reciept->phone,
                    'amount' => $reciept->amount,
                    'refunded' => $reciept->refunded,
                    'status' => $reciept->status,
                    'updated_at' => $reciept->updated_at->format('d.m.Y H:i:s')
                ];
            }
        }
        return $formattedReciepts;
    }

    public function addReciept(array $order, string $prefix, string $orderNum): array
    {
        try {
            DB::beginTransaction();
            $orderName = sprintf('%s-%s', $prefix, $orderNum);
            $createArr = [
                'name' => $orderName,
                'customer' => $order['customer_name'],
                'email' => $order['customer_email'],
                'phone' => $order['customer_phone'],
                'amount' => $order['total_price'],
                'refunded' => 0,
                'request' => '',
                'response' => '',
                'status' => 0
            ];
            $reciept = Reciept::create($createArr);
            $this->addRecieptPurchases($reciept, $order['items']);
            DB::commit();
            return [
                'message' => 'reciept was added',
                'err' => 'none',
                'data' => $reciept->id
            ];
        } catch (\Exception $exception)
        {
            DB::rollBack();
            return [
                'message' => 'Something went wrong',
                'err' => $exception->getMessage()
            ];
        }
    }

    private function addRecieptPurchases(Reciept $reciept, array $items): void
    {
        foreach ($items as $item)
        {
            $createArr = [
                'reciept_id' => $reciept->id,
                'name' => $item['name'],
                'sku' => $item['sku'],
                'quantity' => $item['quantity'],
                'price' => $item['price'],
                'amount' => $item['amount'],
                'refunded' => 0,
                'vat' => $item['vat'] ?? 20
            ];
            RecieptPurchase::create($createArr);
        }
    }

    public function checkReciept(string $prefix, string $orderNum): ?Reciept
    {
        $name = sprintf('%s-%s', $prefix, $orderNum);
        return Reciept::where('name', $name)->first();
    }
}
