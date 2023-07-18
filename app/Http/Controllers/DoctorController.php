<?php

namespace App\Http\Controllers;

use App\Http\Requests\DoctorLoginRequest;
use App\Models\Process;
use App\Repositories\DoctorRepository;
use App\Repositories\ReceptionRepository;
use App\Services\FaceDetectionService;
use App\Services\SmsService;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    protected const FACE_NOT_DETECT = 0;

    public function __construct(protected SmsService $smsService, protected FaceDetectionService $faceDetectionService, protected DoctorRepository $doctorRepository, protected ReceptionRepository $receptionRepository)
    {
    }

//    Auth function
    public function auth(DoctorLoginRequest $request){
        $doctor = $this->doctorRepository->getDoctor($request->id);
        $res = $this->faceDetectionService->detectFace($request->ImageBase64String);
        if ($res != $doctor->name) return back()->with('backData', self::FACE_NOT_DETECT);
        session()->put('doctor',1);
        session()->put('doctor_id',$doctor->id);
        session()->put('doctor_name',$doctor->name);
        return redirect()->route('doctor_home');
    }

    public function home(){
        $blocks = $this->receptionRepository->getBlocks();
        return view('doctor.home', ['blocks' => $blocks]);
    }

    public function logout_doctor(){
        session()->flush();
        return redirect()->route('doctor_login_page');
    }



//    Patients control
    public function showPatients($block_letter){
        $patients = $this->doctorRepository->getPatients($block_letter, session('doctor_name'));
        return view('doctor.patients', ['patients' => $patients]);
    }

    public function approval_of_inspection(Request $request){
        $request->validate(['id' => 'required|numeric']);
        $process = Process::find($request->id);
        $process->status = 1;
        $this->smsService->notifyPatient($process->phone, $process->user_name, $process->doctor);
        $process->save();
        return back();
    }

    public function patientNotFound(Request $request){
        $request->validate(['id' => 'required|numeric']);
        $process = Process::find($request->id);
        $process->status = 1;
        $this->smsService->patientNotFound($process->user_name, $process->phone);
        $process->save();
        return back();
    }
}
