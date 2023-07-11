<?php

namespace App\Repositories;

use App\Models\Admin;
use App\Models\Block;
use App\Models\Doctor;
use App\Models\Nurse;
use App\Models\Reception;
use App\Models\Ward;
use http\Env\Request;

class AdminRepository
{
//    Admin auth function
    public function checkAdmin($login, $password){
        $admin = Admin::where('login', $login)
            ->where('password', md5(md5($password)))
            ->get();
        return $admin;
    }

//    Get blocks
    public function getBlockUsersCount(){
        return Block::sum('users_count');
    }

//   Get all empty spaces
    public function getAllEmptySpaces(){
//        $users_count = Block::sum('users_count');
//        $spaces = Block::sum('space_count');
//        return $spaces-$users_count;
        $result = Block::selectRaw('SUM(space_count) - SUM(users_count) AS empty_spaces')
            ->first();
        return $result;
    }

//    Doctors count
    public function getDoctorsCount(){
        return Doctor::count('id');
    }

//    Get all blocks
    public function getBlocks(){
        return Block::all();
    }

//    ADD new block to database
    public function addBlock($letter, $name){
        $block = new Block;
        $block->letter = $letter;
        $block->name = $name;
        $block->save();
    }







    public function getWards()
    {
        return Ward::all();
    }

//    Add war
    public function add_ward($data){
        $block = Block::find($data->block_id);
        $block->increment('ward_count');
        $block->increment('space_count', $data->space_count);

        Ward::create([
            'number' => $data->number,
            'type' => $data->type,
            'block_id' => $data->block_id,
            'space_count' => $data->space_count,
        ]);
    }

//    Get all wards by params
    public function getWardsWithParams($block_id,$type,$status){
        $query = Ward::query();

        if ($block_id !== 'all') {
            $query->where('block_id', $block_id);
        }

        if ($type !== 'all') {
            $query->where('type', $type);
        }

        if ($status !== 'all') {
            $query->where('status', $status);
        }

        return $query->get();
    }


//    Delete block



























//  Get doctors
    public function getDoctors(){
        $doctors = Doctor::orderBy('name')->get();
        return $doctors;
    }


//    GetDoctor
    public function getDoctor($name){
        $doctor = Doctor::where('name', $name)
            ->first();
        return $doctor;
    }


//    Add Doctor
    public function addDoctor($name, $phone, $profession){
        $doctor = new Doctor;
        $doctor->name = $name;
        $doctor->profession = $profession;
        $doctor->phone = $phone;
        $doctor->save();
    }



//    Hamshira va Receptionlar

    public function getNurses(){
        return Nurse::orderBy('name')->get();
    }

    public function getReceptions(){
        return Reception::orderBy('name')->get();
    }


}
