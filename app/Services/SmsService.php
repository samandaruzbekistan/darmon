<?php

namespace App\Services;

use App\Models\Sms;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Config;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

class SmsService
{
    protected string $email;
    protected string $password;

    public function __construct()
    {
        $this->email = Config::get('app.email', 'your@mail.com');
        $this->password = Config::get('app.password', 'password');
    }

    public function notifyDoctor($doctor_name, $address, $number1, $ward){
        $number = preg_replace('/\D/', '', $number1);
        if (strlen($number) == 9) {
            $number = "998".$number;
        }
        $token = Sms::find(1);
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
                    'contents' => "Hurmatli {$doctor_name} sizga yangi bemor keldi. Joylashuv: {$address} blok, {$ward}-palata"
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
        $res = $user->sendAsync($request,$options1)->wait()->getBody()->getContents();;
        return $res;
    }

    public function notifyPatient($number1, $name, $doctor){
        $number = preg_replace('/\D/', '', $number1);
        if (strlen($number) == 9) {
            $number = "998".$number;
        }
        $token = Sms::find(1);
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
        $vaqt = date('Y-m-d');
        $soat = date('h:i');
        $options1 = [
            'multipart' => [
                [
                    'name' => 'mobile_phone',
                    'contents' => "{$number}"
                ],
                [
                    'name' => 'message',
                    'contents' => "Hurmatli {$name} siz shifokor {$doctor} tomonidan {$vaqt} kuni soat {$soat} da ko'rikdan o'tkazildingiz. Talab va takliflaringizni: 994776758 ga yuboring"
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
        $res = $user->sendAsync($request,$options1)->wait()->getBody()->getContents();;
        return $res;
    }


    public function patientNotFound($name, $number1){
        $number = preg_replace('/\D/', '', $number1);
        if (strlen($number) == 9) {
            $number = "998".$number;
        }
        $token = Sms::find(1);
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
        $vaqt = date('Y-m-d');
        $soat = date('h:i');
        $options1 = [
            'multipart' => [
                [
                    'name' => 'mobile_phone',
                    'contents' => "{$number}"
                ],
                [
                    'name' => 'message',
                    'contents' => "Hurmatli {$name} siz {$vaqt} kuni soat {$soat} da palatada bo'lamaganligingiz sababli ko'rikdan o'tkazilmadingiz. Iltimos shifokoringizga uchrashing"
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
        $res = $user->sendAsync($request,$options1)->wait()->getBody()->getContents();;
        return $res;
    }

    public function sendSMS($numbers, $message){
        $token = Sms::find(1);
        $current_date = Carbon::now();
        $token_expiry_date = Carbon::parse($token->updated_at)->addMonth();
        if($current_date->greaterThan($token_expiry_date)){
            $re = $this->getToken();
            if ($re['message'] == 'error') return response()->json(['message'=> 'error'], 200);
        }
        $token = $token->token;
        $messages = [];
        foreach ($numbers as $index => $number) {
            $messages[] = [
                "user_sms_id" => "sms" . ($index + 1),
                "to" => $number->phone,
                "text" => $message,
            ];
        }

        $data = [
            "messages" => $messages,
            "from" => "4546",
            "dispatch_id" => 123
        ];
//        dd(json_encode($data));
        $response = Http::withToken($token)
            ->withHeaders(['Content-Type' => 'application/json'])
            ->post('https://notify.eskiz.uz/api/message/sms/send-batch', $data);
        // Check if the request was successful
        if ($response->successful()) {
            // Return the response JSON or extract specific data as needed
            return $response->json();
        } else {
            // Return an error message or handle the failed request
            return json_decode($response->body(), true);
        }
        //        $user = new Client();
//        $headers = [
//            'Authorization' => "Bearer {$token}"
//        ];
//        $messages = [];
//        foreach ($numbers as $index => $number) {
//            $messages[] = [
//                "user_sms_id" => "sms" . ($index + 1),
//                "to" => $number->phone,
//                "text" => "This is a test SMS to number",
//            ];
//        }
//
//        $data = [
//            "messages" => $messages,
//            "from" => "4546",
//            "dispatch_id" => 123
//        ];
//
//        // Convert the payload to JSON format
//        $jsonPayload = json_encode($data);
//        $new = '{
//    "messages": [
//        {"user_sms_id":"sms1","to": 998975672009, "text": "eto test"},
//        {"user_sms_id":"sms2","to": 998975672009, "text": "eto test 2"}
//    ],
//    "from": "4546",
//    "dispatch_id": 123
//}';
//        $request = new \GuzzleHttp\Psr7\Request('POST', 'notify.eskiz.uz/api/message/sms/send-batch', $headers, $new);
//
//        $res = $user->sendAsync($request)->wait();
//        return $res->getBody();
    }

    public function getLimit(){
        $token = Sms::find(1);
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
        $request = new \GuzzleHttp\Psr7\Request('GET', 'http://notify.eskiz.uz/api/user/get-limit', $headers);
        $res = $user->sendAsync($request)->wait()->getBody()->getContents();;
        return json_decode($res, true);
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
