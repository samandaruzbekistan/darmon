<?php

namespace App\Repositories;

use App\Interfaces\ReceptionRepositoryInterface;
use App\Models\Block;
use App\Models\District;
use App\Models\Doctor;
use App\Models\Process;
use App\Models\Quarter;
use App\Models\Reception;
use App\Models\Region;
use App\Models\User;
use App\Models\Ward;

use http\Env\Response;
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





//    User qo'shish
    public function addUser($data){
        $user = new User($data->all());
        $user->disease = $data->disease ?? null;
        $user->reception_id = session('reception_id');
        $user->save();
        $userID = $user->id;

        $block = Block::find($data->block_id);
        $block->users_count = $block->users_count + 1;
        $block->filled_prosent = ($block->users_count + 1)*100/$block->space_count;
        $block->save();

        $ward = Ward::find($data->ward_id);
        if ($ward->space_count == ($ward->users_count + 1)) $ward->status = 2;
        if ($ward->status == 0) $ward->status = 1;
        $ward->users_count = $ward->users_count + 1;
        $ward->empty_space = $ward->empty_space - 1;
        $ward->save();

        $rowsToInsert = [];
        $currentDate = $data->arrival_date;
        $currentDate2 = $data->arrival_date;
        $endDate = $data->departure_date;

        while ($currentDate <= $endDate) {
            $row = [
                'user_id' => $userID,
                'user_name' => $data->name,
                'doctor' => $data->doctor,
                'date' => $currentDate,
                'type' => 1, // day
                'phone' => $data->phone,
                'status' => 0, // or any default status
            ];

            $rowsToInsert[] = $row;

            // Move to the next day
            $currentDate = date('Y-m-d', strtotime($currentDate . ' +1 day'));
        }

        $currentDate2 = date('Y-m-d', strtotime($currentDate2 . ' +1 day'));
        while ($currentDate2 <= $endDate) {
            $row = [
                'user_id' => $userID,
                'user_name' => $data->name,
                'doctor' => $data->doctor,
                'date' => $currentDate2,
                'type' => 2, // day
                'phone' => $data->phone,
                'status' => 0, // or any default status
            ];

            $rowsToInsert[] = $row;

            // Move to the next day
            $currentDate2 = date('Y-m-d', strtotime($currentDate2 . ' +1 day'));
        }

        Process::insert($rowsToInsert);

        return response()->json([
            'success' => true,
            'last_insert_id' => $data->id
        ], 200);
    }

//    Userlarni bazadan qidirish
    public function searchUser($name){
        $users = User::where('name','LIKE',"%{$name}%")->get();
        return $users;
    }


//    Userlarni olish palata bo'yicha
    public function getUsers($id){
        $users = User::where('ward_id', $id)->get(['name', 'arrival_date','departure_date']);
        return $users;
    }

//    Userlarni olish name bo'yicha
    public function getUsersByName($name){
        if ($name == '') return [];
        $users = User::join('blocks', 'users.block_id', '=', 'blocks.id')
                    ->join('wards', 'users.ward_id', '=', 'wards.id')
                    ->whereRaw('LOWER(users.name) LIKE ?', ['%' . strtolower($name) . '%'])
                    ->select('users.name', 'users.phone', 'blocks.name as block_name', 'wards.number as ward_number')
                    ->get();
        return $users;
    }

//    Bitta userni olish
    public function getUser($name){
        return User::where('name', $name);
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



//    Get doctor by name
    public function getDoctor($name){
        return Doctor::where('name', $name);
    }


}
