<?php

namespace App\Repositories;

use App\Models\Admin;
use App\Models\Block;
use App\Models\Doctor;
use App\Models\Ward;

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
        return Doctor::sum('id');
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

//    Get all wards
    public function getWards($block_id,$type,$status){
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
}
