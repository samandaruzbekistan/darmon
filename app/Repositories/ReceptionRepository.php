<?php

namespace App\Repositories;

use App\Interfaces\ReceptionRepositoryInterface;
use App\Models\Block;
use App\Models\District;
use App\Models\Doctor;
use App\Models\Quarter;
use App\Models\Reception;
use App\Models\Region;
use App\Models\User;
use App\Models\Ward;
use Illuminate\Support\Facades\DB;

class ReceptionRepository
{

    public function getReception($login, $password)
    {
        $reception = Reception::where('login', $login)
                ->where('password', md5(md5($password)))
                ->get();
        return $reception;
    }



//    Blocklarni qaytaradi
    public function getBlocks(){
        $blocks = Block::all();
        return $blocks;
    }


//    Block palatalarini qaytaradi
    public function getWards($id){
        $rooms = Ward::where('block_id', $id)->get();
        return $rooms;
    }


//  Palata malumotlarni qaytaradi
    public function showWard($id){
        $ward = Ward::find($id);
        return $ward;
    }

//    Userlarni bazadan qidirish
    public function searchUser($name){
        $users = User::where('name','LIKE',"%{$name}%")->get();
        return $users;
    }


//    Userlarni olish palata bo'yicha
    public function getUsers($id){
        $users = User::where('ward_id', $id)->get();
        return $users;
    }

//    Userlarni olish name bo'yicha
    public function getUsersByName($name){
        if ($name == '') return [];
        $users = User::join('blocks', 'users.block_id', '=', 'blocks.id')
                    ->join('wards', 'users.ward_id', '=', 'wards.id')
                    ->whereRaw('LOWER(users.name) LIKE ?', ['%' . strtolower($name) . '%'])
                    ->select('users.name', 'users.phone', 'blocks.name as block_name', 'wards.name as ward_name')
                    ->get();
        return $users;
    }





//    Viloyatlarni qaytaradi
    public function getRegions(){
        return Region::orderBy('name_uz')->get(['id', 'name_uz as name']);
    }

//    Tumanlarni viloyat_id bo'yicha qaytaradi
    public function getDistricts($id){
        return District::where('region_id', $id)->orderBy('name_uz')->get(['id', 'name_uz as name']);
    }

//    Mahallalarni tuman_id bo'yicha qaytaradi
    public function getQuarters($id){
        return Quarter::where('district_id', $id)->orderBy('name')->get(['id', 'name']);
    }




//    Get all Doctors
    public function getAllDoctors(){
        return Doctor::orderBy('name')->get(['id', 'name', 'profession']);
    }



//    User add to ward


}
