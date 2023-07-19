<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReceptionAuthRequest;
use App\Repositories\NurseRepository;
use App\Repositories\ReceptionRepository;
use App\Services\SmsService;
use Illuminate\Http\Request;

class NurseController extends Controller
{

    public function __construct(protected NurseRepository $nurseRepository, protected ReceptionRepository $receptionRepository, protected SmsService $smsService)
    {
    }

    public function auth(ReceptionAuthRequest $request){
        $res = $this->nurseRepository->getNurse($request->login, $request->password);
        if (count($res) != 0){
            session()->put('nurse',$res[0]->id);
            session()->put('nurse_name', $res[0]->name);
            session()->put('nurse_id', $res[0]->id);
            return redirect(route('nurse_home'));
        }
        else{
            return redirect(route('nurse_login_page'));
        }
    }


    //    Nurse logout
    public function logout_nurse(){
        session()->flush();
        return redirect()->route('nurse_login_page');
    }


    public function home()
    {
        return view('nurse.home')->with('blocks', $this->receptionRepository->getBlocks());
    }

    public function showWard($id){
        if (!isset($id)){
            return back();
        }
        $wards = $this->receptionRepository->getWards($id);
        return view('nurse.wards', ['wards' => $wards]);
    }

    public function getPatientById($id){
        $user = $this->nurseRepository->getPatientById($id);
        $blocks = $this->receptionRepository->getBlocks();
        $wards = $this->receptionRepository->getWards($user->block_id);
        return response()->json([$user, $blocks,$wards]);
    }

    public function getWardById($id){
        $wards = $this->receptionRepository->getWards($id);
        return response()->json($wards);
    }

    public function getUsers($id){
        $users = $this->receptionRepository->getUsers($id);
        $ward = $this->receptionRepository->showWard($id);
        return response()->json([$users, $ward]);
    }

    public function searchUsers(Request $request){
        $users = $this->receptionRepository->getUsersByName($request->name);
        return response()->json($users);
    }

    public function edit_patient(Request $request){
        $request->validate([
            'block_id' => "required|numeric",
            'ward_id' => "required|numeric",
            'departure_date' => "required",
            'user_id' => "required|numeric",
            'phone' => "required|numeric|digits:12",
            'phone2' => "numeric|digits:12",
        ]);
        $user = $this->nurseRepository->getPatientById($request->user_id);
        $block = $this->nurseRepository->getBlock($request->block_id);
        $ward = $this->nurseRepository->getWard($request->ward_id);
        $doctor = $this->receptionRepository->getDoctor($user->doctor);
        if ($user->departure_date < $request->departure_date){
            $start = date('Y-m-d', strtotime($user->departure_date . ' +1 day'));
            $this->nurseRepository->addDays($start, $request->departure_date, $user, $block, $ward,$request->phone);
        }
        if ($request->block_id != $user->block_id){
            $this->nurseRepository->decrementBlock($user->block_id);
            $this->nurseRepository->incrementBlock($request->block_id);
        }
        if ($request->ward_id != $user->ward_id){
            $this->nurseRepository->decrementWard($user->ward_id);
            $this->nurseRepository->incrementWard($request->ward_id);
            $this->smsService->notifyDoctorChangeUser($user->doctor, $block->name, $doctor->phone, $ward->number, $user->name);
        }
        $this->nurseRepository->updatePatient($request->input());
        return back()->with('backData', 3);
    }

    public function remove_patient(Request $request){
        $request->validate(['user_id' => "required|numeric"]);
        $user = $this->nurseRepository->getPatientById($request->user_id);
        $this->nurseRepository->remove_process($request->user_id);
        $this->nurseRepository->decrementWard($user->ward_id);
        $this->nurseRepository->decrementBlock($user->block_id);
        $this->nurseRepository->removePatient($user->id);
        return back()->with('backData', 4);
    }
}
