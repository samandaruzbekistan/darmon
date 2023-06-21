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



// Receptionni auth qilish
    public function auth(ReceptionAuthRequest $request){
        $result = $this->receptionService->checkReception($request->login, $request->password);
        if($result == 1){
            return redirect(route('reception_home'));
        }
        else{
            return redirect(route('reception_login'));

        }
    }

//    Reception logout
    public function logout_reception(){
        $this->receptionService->logout();
        return redirect()->route('reception_login_page');
    }


//    Receptionning bosh sahifasi. Blocklarni qaytaradi.
    public function reception_home(){
        return view('reception.home')->with('blocks', $this->receptionService->getBlocks());
    }


//    Palatani ko'rish
    public function showWard($id){
        if (!isset($id)){
            return back();
        }
        $wards = $this->receptionService->getWards($id);
        return view('reception.wards')->with('wards', $wards);
    }

}
