<?php

namespace App\Http\Controllers\Reciepts;

use App\Http\Controllers\Api\SimplaOrderApi;
use App\Http\Controllers\Controller;
use App\Http\Requests\Reciepts\SimplaOrderReciept;
use App\Services\SettingsService;
use Illuminate\Http\Request;

class GetSimplaOrderReciept extends Controller
{
    private SettingsService $settingsService;
    private SimplaOrderApi $simplaOrderApi;

    public function __construct(SettingsService $settingsService, SimplaOrderApi $simplaOrderApi)
    {
        $this->settingsService = $settingsService;
        $this->simplaOrderApi = $simplaOrderApi;
    }

    public function __invoke(SimplaOrderReciept $request)
    {
        $data = $request->validated();
        $orderArr = explode('-', $data['order']);
        $prefix = trim($orderArr[0]);
        $orderNum = trim($orderArr[1]);
        $database = $this->settingsService->getRecieptSettings($prefix);
        if($database){
            $simplaOrder = $this->simplaOrderApi->getOrder($orderNum, $database);
            if($simplaOrder){
                dd($simplaOrder);
            }
        }
        return response()->json(['message' => 'something went wrong'], 500);
    }
}
