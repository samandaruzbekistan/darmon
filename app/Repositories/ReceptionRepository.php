<?php

namespace App\Repositories;

use App\Interfaces\ReceptionRepositoryInterface;
use App\Models\Block;
use App\Models\Reception;
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
        $users = User::where('ward_id', $id)->get();
        return ['ward' => $ward, 'users' => $users];
    }

//    Userlarni bazadan qidirish
    public function searchUser($name){
        $users = User::where('name','LIKE',"%{$name}%")->get();
        return $users;
    }


}
