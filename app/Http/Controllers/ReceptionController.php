<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReceptionAuthRequest;
use App\Http\Services\ReceptionService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ReceptionController extends Controller
{
    public function __construct(protected ReceptionService $receptionService,)
    {
    }




    public function auth(ReceptionAuthRequest $request){
        $result = $this->receptionService->checkReception($request->login, $request->password);
        if($result == 1){
            return 'aaa';
        }
        else{
            return 'bb';
        }

    }

}
