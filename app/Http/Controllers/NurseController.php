<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReceptionAuthRequest;
use App\Repositories\NurseRepository;
use App\Repositories\ReceptionRepository;
use Illuminate\Http\Request;

class NurseController extends Controller
{

    public function __construct(protected NurseRepository $nurseRepository, protected ReceptionRepository $receptionRepository)
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
    public function logout_reception(){
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
}
