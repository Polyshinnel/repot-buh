<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Utils\CommonUtils;
use Illuminate\Http\Request;

class SimplaOrderApi extends Controller
{
    private CommonUtils $commonUtils;

    public function __construct(CommonUtils $commonUtils)
    {
        $this->commonUtils = $commonUtils;
    }

    public function getOrder(string $orderNum, string $database): ?array
    {
        $url = 'https://herlitzbags.ru/index.php?module=OrderApiView';
        $data = [
            'api_method' => 'get_order_purchase',
            'order_id' => $orderNum,
            'database' => $database
        ];

        $response = $this->commonUtils->postFormRequest($url, $data);
        if($response){
            return json_decode($response, true);
        }
        return null;
    }
}
