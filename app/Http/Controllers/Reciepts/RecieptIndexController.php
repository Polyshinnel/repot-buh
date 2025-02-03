<?php

namespace App\Http\Controllers\Reciepts;

use App\Http\Controllers\Controller;
use App\Services\RecieptService;
use Illuminate\Http\Request;

class RecieptIndexController extends Controller
{
    private RecieptService $recieptService;
    public function __invoke(RecieptService $recieptService)
    {
        $reciepts = $recieptService->getReciepts();
        return response()->json(['reciepts' => $reciepts]);
    }
}
