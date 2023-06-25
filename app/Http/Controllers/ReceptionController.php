<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReceptionAuthRequest;
use App\Http\Services\ReceptionService;
use App\Repositories\ReceptionRepository;
use Illuminate\Http\Request;


class ReceptionController extends Controller
{
    public function __construct(protected ReceptionService $receptionService, protected ReceptionRepository $receptionRepository)
    {
    }



// Receptionni auth qilish
    public function auth(ReceptionAuthRequest $request){
        $result = $this->receptionService->checkReception($request->login, $request->password);
        if($result == 1){
            return redirect(route('reception_home'));
        }
        else{
            return redirect(route('reception_login_page'));

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


//    Palata userlarini olish
    public function getUsers($id){
        $users = $this->receptionRepository->getUsers($id);
        return response()->json($users);
    }

//    userlarini qidirish
    public function searchUsers(Request $request){
        $users = $this->receptionRepository->getUsersByName($request->name);
        return response()->json($users);
    }




//    Viloyatlarni qaytaradi
    public function getRegions(){
        return $this->receptionRepository->getRegions();
    }

//    Tumanlarni viloyat_id bo'yicha qaytaradi
    public function getDistricts($id = 1){
        return $this->receptionRepository->getDistricts($id);
    }

//    Mahallalarni tuman_id bo'yicha qaytaradi
    public function getQuarters($id = 1){
        return $this->receptionRepository->getQuarters($id);
    }


//    Doctorlarni qaytaradi
    public function getDoctors(){
        return $this->receptionRepository->getAllDoctors();
    }

}
