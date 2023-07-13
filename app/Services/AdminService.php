<?php

namespace App\Services;

use App\Models\Block;
use App\Models\Ward;
use App\Repositories\AdminRepository;
use GuzzleHttp\Client;

class AdminService
{
    public function __construct(protected AdminRepository $adminRepository, )
    {
    }

    const UNSUCCESSFUL = 0;
    const SUCCESSFUL = 1;
    const FACE_NOT_DETECTED = 2;
    const API_ERROR = 3;
    protected string $url_add_face = "https://portal.gspi.uz/Face/Add";

    public function adminCheck($login, $password){
        $res = $this->adminRepository->checkAdmin($login, $password);
        if (count($res) != 0){
            session()->put('admin',$res[0]->id);
            session()->put('admin_name', $res[0]->name);
            return 1;
        }
        else{
            return 0;
        }
    }

    public function logout(){
        session()->flush();
    }

    public function home(){
        $users = $this->adminRepository->getBlockUsersCount();
        $empty_spaces = $this->adminRepository->getAllEmptySpaces();
        $doctors = $this->adminRepository->getDoctorsCount();

        return ['users' => $users, 'empty_spaces' => $empty_spaces->empty_spaces, 'doctors' => $doctors];
    }

    public function getBlocks(){
        return $this->adminRepository->getBlocks();
    }

    public function addBlock($letter, $name){
        $this->adminRepository->addBlock($letter, $name);
    }

    public function getWards($block_id,$type,$status){
        return $this->adminRepository->getWardsWithParams($block_id, $type,$status);
    }






}
