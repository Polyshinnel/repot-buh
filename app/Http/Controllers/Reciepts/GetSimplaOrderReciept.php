<?php

namespace App\Http\Controllers\Reciepts;

use App\Http\Controllers\Api\SimplaOrderApi;
use App\Http\Controllers\Controller;
use App\Http\Requests\Reciepts\SimplaOrderReciept;
use App\Services\RecieptService;
use App\Services\SettingsService;
use Illuminate\Http\Request;

class GetSimplaOrderReciept extends Controller
{
    private SettingsService $settingsService;
    private SimplaOrderApi $simplaOrderApi;
    private RecieptService $recieptService;

    public function __construct(
        SettingsService $settingsService,
        SimplaOrderApi $simplaOrderApi,
        RecieptService $recieptService
    )
    {
        $this->settingsService = $settingsService;
        $this->simplaOrderApi = $simplaOrderApi;
        $this->recieptService = $recieptService;
    }

    public function __invoke(SimplaOrderReciept $request)
    {
        $data = $request->validated();
        $orderArr = explode('-', $data['order']);
        $prefix = trim($orderArr[0]);
        $orderNum = trim($orderArr[1]);

        $checkReciept = $this->recieptService->checkReciept($prefix, $orderNum);
        if(!$checkReciept)
        {
            $database = $this->settingsService->getRecieptSettings($prefix);

            if($database){
                $simplaOrder = $this->simplaOrderApi->getOrder($orderNum, $database);
                if(!empty($simplaOrder['items'])){
                    $data = $this->recieptService->addReciept($simplaOrder, $prefix, $orderNum);
                    if($data['err'] != 'none')
                    {
                        return response()->json($data, 500);
                    }
                    return response()->json($data);
                }
            }
        } else {
            return response()->json(['message' => 'existed reciept', 'err' => 'none', 'data' => $checkReciept->id]);
        }
        return response()->json(['message' => 'database or order not found'], 500);
    }
}
