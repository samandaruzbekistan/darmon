<?php

namespace App\Http\Controllers;

use App\Http\Requests\DoctorLoginRequest;
use App\Repositories\DoctorRepository;
use App\Repositories\ReceptionRepository;
use App\Services\FaceDetectionService;
use Illuminate\Http\Request;

class DoctorController extends Controller
{

    public function __construct(protected FaceDetectionService $faceDetectionService, protected DoctorRepository $doctorRepository, protected ReceptionRepository $receptionRepository)
    {
    }

//    Auth function
    public function auth(DoctorLoginRequest $request){
        $doctor = $this->doctorRepository->getDoctor($request->id);
//        $res = $this->faceDetectionService->detectFace($request->ImageBase64String);
        session()->put('doctor',1);
        session()->put('doctor_id',$doctor->id);
        session()->put('doctor_name',$doctor->name);
        return redirect()->route('doctor_home');
    }

    public function home(){
        $blocks = $this->receptionRepository->getBlocks();
        return view('doctor.home', ['blocks' => $blocks]);
    }

    public function showPatients($block_letter){
        $patients = $this->doctorRepository->getPatients($block_letter, session('doctor_name'));
        return view('doctor.patients', ['patients' => $patients]);
    }
}
