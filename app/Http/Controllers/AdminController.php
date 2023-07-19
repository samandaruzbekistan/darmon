<?php

namespace App\Http\Controllers;

use App\Exports\Blocks;
use App\Http\Requests\AdminRequest;
use App\Services\AdminService;
use App\Services\FaceDetectionService;
use App\Repositories\AdminRepository;
use App\Services\SmsService;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Maatwebsite\Excel\Facades\Excel;
use Termwind\Html\InheritStyles;

class AdminController extends Controller
{
    public function __construct(protected SmsService $smsService, protected AdminService $adminService, protected AdminRepository $adminRepository, protected FaceDetectionService $faceDetectionService)
    {
    }



    const UNSUCCESSFUL = 0;
    const SUCCESSFUL = 1;
    const FACE_NOT_DETECTED = 2;
    const API_ERROR = 3;
    const NAME_ERROR = 4;
    const LOGIN_ERROR = 5;



//    Auth
    public function auth(Request $request){
        $result = $this->adminService->adminCheck($request->login, $request->password);
        if($result == self::SUCCESSFUL){
            return redirect(route('admin_home'));
        }
        else{
            return redirect(route('admin_login_page'));
        }
    }

//    Logout
    public function logout(){
        $this->adminService->logout();
        return redirect()->route('admin_login_page');
    }




//    Admin home
    public function home(){
        $res = $this->adminService->home();
        return view('admin.home', ['data' => $res]);
    }





//    Bloklar royhati
    public function blocks(){
        return view('admin.blocks', ['blocks' => $this->adminService->getBlocks()]);
    }

//    Block qo'shish
    public function add_block(Request $request){
        $validated = $request->validate([
            'block_letter' => 'required|string',
            'block_name' => 'required|string',
        ]);
        $this->adminService->addBlock($request->block_letter, $request->block_name);
        return back();
    }

//    Export excel
    public function block_export()
    {
        return Excel::download(new Blocks, 'blocks.xlsx');
    }











//  Palata qo'shish
    public function add_ward(Request $request){
        $request->validate([
            'number' => 'required|numeric',
            'space_count' => 'required|numeric',
            'block_id' => 'required|numeric',
            'type' => 'required|string',
        ]);
        $this->adminRepository->add_ward($request);
        return back()->with('backData', self::SUCCESSFUL);
    }


    public function getWards(){
        return view('admin.wards', ['wards' => $this->adminRepository->getWards(),'blocks' => $this->adminRepository->getBlocks()]);
    }


//  Palatalarni json olish
    public function getWardsWithParams(Request $request){
        $block_id = 'all';
        $type = 'all';
        $status = 'all';
        if ($request->has('block_id')) $block_id = $request->block_id;
        if ($request->has('type')) $type = $request->type;
        if ($request->has('status')) $status = $request->status;
        return response()->json($this->adminService->getWards($block_id,$type,$status));
    }















//    Get doctors - All
    public function getDoctors(){
        return view('admin.doctors', ['doctors' => $this->adminRepository->getDoctors()]);
    }

//    Get doctor - 1
    public function getDoctor($name = 'none'){
        if ($name == 'none') return redirect()->route('doctors');
        $doctor =  $this->adminRepository->getDoctor($name);
        if ($doctor){
            return $doctor;
        }
        else{
            return back()->with('doctor_error', 1);
        }
    }

//    Add Doctor
    public function addDoctor(Request $request){
        $validated = $request->validate([
            'name' => 'required',
            'profession' => 'required',
            'phone' => 'required|numeric|digits:12',
            'ImageBase64String' => 'required',
        ]);
        if ($this->adminRepository->getDoctor($request->name)) {
            return back()->with('error', self::NAME_ERROR);
        }

        $res = $this->faceDetectionService->addFace($request->name, $request->ImageBase64String);

        if ($res == self::SUCCESSFUL){
            $this->adminRepository->addDoctor($request->name, $request->phone, $request->profession);
            return back()->with('result', self::SUCCESSFUL);
        }
        elseif ($res == self::API_ERROR){
            return back()->with('result', self::API_ERROR);
        }
        elseif ($res == self::FACE_NOT_DETECTED){
            return back()->with('result', self::FACE_NOT_DETECTED);
        }
        else{
            return back()->with('result', $res);
        }
    }


//    Edit doctor
    public function editDoctor($name){
        return view('admin.doctor_edit');
    }


    public function getFace(Request $request){
        return $this->faceDetectionService->getFace($request->image);
    }








//    Receptionlar funksiyalari

    public function receptions(){
        return view('admin.receptions', ['receptions' => $this->adminRepository->getReceptions()]);
    }

    // Add reception
    public function add_reception(Request $request){
        $validated = $request->validate([
            'name' => 'required|string',
            'login' => 'required|string',
            'phone' => 'required|numeric|digits:12',
            'password' => 'required|string',
        ]);
        if (!empty($this->adminRepository->getReception($request->login))) {
            return back()->with('error', self::LOGIN_ERROR);
        }

        $this->adminRepository->addReception($request->input());
        return back()->with('result', self::SUCCESSFUL);
    }

//    Delete reception
    public function deleteReception($id){
        $this->adminRepository->deleteReception($id);
        return back();
    }

//    Edit reception
    public function editReception($login){
        return $this->adminRepository->getReception($login);
    }

//    Update reception
    public function updateReception(Request $request){
        $request->validate([
            'login' => 'required|string',
            'phone' => 'required|numeric|digits:12',
            'password' => 'required|string',
        ]);
        $this->adminRepository->updateReception($request->input());
        return back();
    }



    public function nurses(){
        return view('admin.nurses', ['nurses' => $this->adminRepository->getNurses()]);
    }

    // Add nurse
    public function add_nurse(Request $request){
        $validated = $request->validate([
            'name' => 'required|string',
            'login' => 'required|string',
            'phone' => 'required|numeric|digits:12',
            'password' => 'required|string',
        ]);
        if (!empty($this->adminRepository->getNurse($request->login))) {
            return back()->with('error', self::LOGIN_ERROR);
        }

        $this->adminRepository->addNurse($request->input());
        return back()->with('result', self::SUCCESSFUL);
    }

//    Delete reception
    public function deleteNurse($id){
        $this->adminRepository->deleteNurse($id);
        return back();
    }

//    Edit reception
    public function editNurse($login){
        return $this->adminRepository->getNurse($login);
    }

//    Update reception
    public function updateNurse(Request $request){
        $request->validate([
            'login' => 'required|string',
            'phone' => 'required|numeric|digits:12',
            'password' => 'required|string',
        ]);
        $this->adminRepository->updateNurse($request->input());
        return back();
    }






//    SMS control
    public function sms(){
        $limit = $this->smsService->getLimit();
        return view('admin.sms', ['balance' => $limit['data']['balance']]);
    }

    public function sendSMS(Request $request){
        $request->validate([
            'to' => 'required|string',
            'message' => 'required|string'
        ]);
        $users = [];
        switch ($request->to) {
            case "doctor":
                $users = $this->adminRepository->getDoctors();
                break;
            case "patient":
                break;
            case "nurse":
                $users = $this->adminRepository->getNurses();
            case "reception":
                $users = $this->adminRepository->getReceptionsNumbers();
                break;
        };
        $response = $this->smsService->sendSMS($users,$request->message);
        if ($response['status'] == "success"){
            return back()->with('backData', self::SUCCESSFUL);
        }
        else{
            return back()->with('backData', self::UNSUCCESSFUL);
        }
    }

}
