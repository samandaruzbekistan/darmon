<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Http;

class FaceDetectionService
{
    protected string $urlFaceDetect = 'https://portal.gspi.uz';
    protected string $urlAddFace = 'https://portal.gspi.uz/Face/Add';
    const UNSUCCESSFUL = 0;
    const SUCCESSFUL = 1;
    const FACE_NOT_DETECTED = 2;
    const API_ERROR = 3;


    public function getFace($image){
        global $urlFaceDetect;
        $user = new Client();
        $options1 = [
            'multipart' => [
                [
                    'name' => 'ImageBase64String',
                    'contents' => "{$image}"
                ],
            ]];
        $request = new \GuzzleHttp\Psr7\Request('POST', $this->urlFaceDetect);
        $res = $user->sendAsync($request,$options1)->wait();
        return $res;
    }


    public function addFace($name, $ImageBase64String){
        global $urlAddFace;
        $user = new Client([
            'verify' => false,
        ]);
        $options1 = [
            'multipart' => [
                [
                    'name' => 'ImageBase64String',
                    'contents' => "{$ImageBase64String}"
                ],
                [
                    'name' => 'name',
                    'contents' => "{$name}"
                ],
            ]
        ];

        try {
            $request = new Request('post', $this->urlAddFace);
            $response = $user->sendAsync($request, $options1)->wait();

            if ($response->getBody() == "Yangi yuz qo'shildi") {
                return self::SUCCESSFUL;
            }
            elseif ($request->getBody() == 'Yuz aniqlanmadi !'){
                return self::FACE_NOT_DETECTED;
            }

            return self::API_ERROR;
        } catch (\GuzzleHttp\Exception\RequestException $exception) {
            // Handle the exception or report the error to the controller
            // For example, you can log the error or return a specific error code
            return self::API_ERROR;
        }
    }

}
