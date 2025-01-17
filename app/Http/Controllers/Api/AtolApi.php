<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AtolApi extends Controller
{

    private string $api_version = 'v4';

    private string $login;

    private string $pass;

    private string $group_code;

    private string $inn = '7716795872';

    private array $token = array(
        "code" => 2,
        "text" => "Не получен",
        "token" => "",
    );

    public function __construct()
    {
        $this->login = config('atol.login');
        $this->pass = config('atol.pass');
        $this->group_code = config('atol.group');
        $this->getToken();
    }

    public function send(string $url, array|null $data): false|array
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        if ($data) {
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data, JSON_UNESCAPED_UNICODE));
        }
        if ($this->token["token"]) {
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                    'Content-type: application/json; charset=utf-8',
                    'Token: ' . $this->token["token"],
                )
            );
        }
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        $res = curl_exec($ch);
        curl_close($ch);
        return json_decode($res, true);
    }


    protected function getToken(): bool
    {
        $rez = $this->send('https://online.atol.ru/possystem/' . $this->api_version . '/getToken?login=' . $this->login . '&pass=' . $this->pass, null);
        if (is_array($rez)) {
            $this->token = $rez;
            return true;
        }
        return false;
    }

    public function check_token(): bool
    {
        return (empty($this->token["error"]) && !empty($this->token["token"]));
    }

    /*
    $operation - Тип документа
    o sell: чек «Приход»;
    o sell_refund: чек «Возврат прихода»;
    o sell_correction: чек «Коррекция прихода»;
    o buy: чек «Расход»;
    o buy_refund: чек «Возврат расхода»;
    o buy_correction: чек «Коррекция расхода».

    $params - параметры документа
    */
    public function send_doc($operation, $params): false|array
    {
        return $this->send('https://online.atol.ru/possystem/' . $this->api_version . '/' . $this->group_code . '/' . $operation . '?tokenid=' . $this->token['token'], $params);
    }

    public function check_doc($uuid): false|array
    {
        return $this->send('https://online.atol.ru/possystem/' . $this->api_version . '/' . $this->group_code . '/report/' . $uuid . '?tokenid=' . $this->token['token'], null);
    }

    public function sell($data): false|array
    {
        return $this->send_doc('sell', $data);
    }

    public function refund($data): false|array
    {
        return $this->send_doc('sell_refund', $data);
    }
}
