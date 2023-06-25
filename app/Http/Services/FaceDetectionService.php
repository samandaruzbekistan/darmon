<?php

namespace App\Http\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;

class FaceDetectionService
{
    protected string $urlFaceDetect = 'https://portal.gspi.uz';
    protected string $urlFaceAddFace = 'https://portal.gspi.uz/Face/Add';

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
        $request = new \GuzzleHttp\Psr7\Request('POST', $urlFaceDetect);
        $res = $user->sendAsync($request,$options1)->wait();
        return $res;
    }

}
