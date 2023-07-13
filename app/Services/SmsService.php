<?php

namespace App\Services;

use App\Models\Sms;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Config;

class SmsService
{
    protected string $email;
    protected string $password;

    public function __construct()
    {
        $this->email = Config::get('app.email', 'your@mail.com');
        $this->password = Config::get('app.password', 'password');
    }

    public function notifyDoctor($doctor_name, $address, $number1){
        $number = preg_replace('/\D/', '', $number1);
        if (strlen($number) == 9) {
            $number = "998".$number;
        }
        $token = Sms::find(1)->token;
        $current_date = Carbon::now();
        $token_expiry_date = Carbon::parse($token->updated_at)->addMonth();
        if($current_date->greaterThan($token_expiry_date)){
            $re = $this->getToken();
            if ($re['message'] == 'error') return response()->json(['message'=> 'error'], 200);
        }
        $token = $token->token;
        $user = new Client();
        $headers = [
            'Authorization' => "Bearer {$token}"
        ];
        $options1 = [
            'multipart' => [
                [
                    'name' => 'mobile_phone',
                    'contents' => "{$number}"
                ],
                [
                    'name' => 'message',
                    'contents' => "{$doctor_name} sizga yangi bemor keldi. Joylashuv: {$address} blok"
                ],
                [
                    'name' => 'from',
                    'contents' => '4546'
                ],
                [
                    'name' => 'callback_url',
                    'contents' => 'http://0000.uz/test.php'
                ]
            ]];
        $request = new \GuzzleHttp\Psr7\Request('POST', 'notify.eskiz.uz/api/message/sms/send', $headers);
        $res = $user->sendAsync($request,$options1)->wait();
        return $res;
    }

    protected function getToken(){
        $client = new Client();
        $options = [
            'multipart' => [
                [
                    'name' => 'email',
                    'contents' => $this->email
                ],
                [
                    'name' => 'password',
                    'contents' => $this->password
                ]
            ]];
        $request = new \GuzzleHttp\Psr7\Request('POST', 'notify.eskiz.uz/api/auth/login');
        $res = $client->sendAsync($request, $options)->wait();
        $respon =  $res->getBody()->getContents();
        // $dt = $respon['data'];
        $dt = json_decode($respon, true);
        if ($dt['message'] == "token_generated"){
            Sms::where('id', 1)
                ->update([
                    'token' => $dt['data']['token']
                ]);
            return ['message' => "token_updated"];
        }
        else{
            return ['message' => "error"];
        }
    }
}
