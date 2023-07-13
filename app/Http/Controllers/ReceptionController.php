<?php

/**
 * Reception controller.
 *
 * @author Samandar Sariboyev <t.me@Samandar_developer>
 * @since 2023
 */

namespace App\Http\Controllers;

use App\Http\Requests\AddUserRequest;
use App\Http\Requests\ReceptionAuthRequest;
use App\Models\Block;
use App\Repositories\ReceptionRepository;
use App\Services\ReceptionService;
use App\Services\SmsService;
use Carbon\Carbon;
use Illuminate\Http\Request;


class ReceptionController extends Controller
{
    public function __construct(protected ReceptionService $receptionService, protected ReceptionRepository $receptionRepository, protected SmsService $smsService)
    {
    }

    const UNSUCCESSFUL = 0;
    const SUCCESSFUL = 1;
    const FACE_NOT_DETECTED = 2;
    const SMS_ERROR = 3;
    const DATE_ERROR = 4;

// Receptionni auth qilish
    public function auth(ReceptionAuthRequest $request){
        $res = $this->receptionRepository->getReception($request->login, $request->password);
        if (count($res) != 0){
            session()->put('reception',$res[0]->id);
            session()->put('reception_name', $res[0]->name);
            session()->put('reception_id', $res[0]->id);
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
        $doctors = $this->receptionRepository->getAllDoctors();
        $wards = $this->receptionRepository->getWards($id);
        return view('reception.wards', ['doctors' => $doctors, 'wards' => $wards, 'regions' => $this->receptionRepository->getRegions()]);
    }





//    Palata userlarini olish
    public function getUsers($id){
        $users = $this->receptionRepository->getUsers($id);
        $ward = $this->receptionRepository->showWard($id);
        return response()->json([$users, $ward]);
    }

//    userlarini qidirish name boyicha
    public function searchUsers(Request $request){
        $users = $this->receptionRepository->getUsersByName($request->name);
        return response()->json($users);
    }

//    yangi user qo'shish
    public function addPatient(AddUserRequest $request){
        $user = $this->receptionRepository->getUser($request->name);
        if (count($user) > 0) return back()->with('backData', self::UNSUCCESSFUL);
        if (($request->arrival_date < Carbon::now()) || ($request->arrival_date > $request->departure_date)) return back()->with('backData', self::DATE_ERROR);
        $response = $this->receptionRepository->addUser($request);
        $doctor = $this->receptionRepository->getDoctor($request->doctor);
        $block = Block::find($request->block_id);
        $res = $this->smsService->notifyDoctor($request->doctor, $block->letter, $doctor->phone);
        $jsonEncoded = json_decode($res);
        if ($jsonEncoded->status != "waiting") return back()->with('backData', self::SMS_ERROR);
        return back()->with('backData', self::SUCCESSFUL);
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
