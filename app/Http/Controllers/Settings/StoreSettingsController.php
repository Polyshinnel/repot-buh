<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Http\Requests\Settings\StoreSettingsRequest;
use App\Models\Setting;
use DB;
use Exception;
use Illuminate\Http\Request;

class StoreSettingsController extends Controller
{
    public function __invoke(StoreSettingsRequest $request) {
        $data = $request->validated();
        $createArr = [
            'site_id' => $data['site_id'],
            'payment_id' => $data['payment_id'],
            'shop_id' => $data['shop_id'],
            'api_key' => $data['api_key'],
            'database' => $data['database_name'],
            'prefix' => $data['order_prefix'],
        ];
        try{
            DB::beginTransaction();
            Setting::create($createArr);
            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();
            $message = $exception->getMessage();
            $path = '/settings?hasErr='.$message;
            return response()->redirectTo($path);
        }
        return response()->redirectTo('/settings');
    }
}
