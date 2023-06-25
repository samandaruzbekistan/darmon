<?php

namespace App\Http\Services;

use App\Models\Block;
use App\Models\Ward;
use App\Repositories\AdminRepository;

class AdminService
{
    public function __construct(protected AdminRepository $adminRepository)
    {
    }

    const SUCCESSFUL = 1;
    const UNSUCCESSFUL = 0;

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
        return $this->adminRepository->getWards($block_id, $type,$status);
    }


//    Add Doctor
    public function addDoctor($name, $profession, $phone){
        if ($this->adminRepository->getDoctor($name)) {
            return self::UNSUCCESSFUL;
        }
        $this->adminRepository->addDoctor($name, $profession, $phone);
        return self::SUCCESSFUL;
    }



}
