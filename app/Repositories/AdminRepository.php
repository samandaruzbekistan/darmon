<?php

namespace App\Repositories;

use App\Models\Admin;
use App\Models\Block;
use App\Models\Doctor;
use App\Models\Employee;
use App\Models\Nurse;
use App\Models\Process;
use App\Models\Reception;
use App\Models\User;
use App\Models\Ward;
use Carbon\Carbon;
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

//    Get day process
    public function getDayProcess(){
        return Process::where('date', date('Y-m-d'))->get();
    }





    public function getWards()
    {
        return Ward::all();
    }

//    Add war
    public function add_ward($data){
        Ward::create([
            'number' => $data->number,
            'type' => $data->type,
            'block_id' => $data->block_id,
            'space_count' => $data->space_count,
        ]);

        $block = Block::find($data->block_id);
        $block->increment('ward_count');
        $block->filled_prosent = ($block->users_count)*100/($block->space_count+$data->space_count);
        $block->increment('space_count', $data->space_count);
        $block->save();
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



//  Receptionlar
    public function getReceptions(){
        return Reception::orderBy('name')->get();
    }

    public function getReceptionsNumbers(){
        return Reception::all(['phone']);
    }

    public function getReception($login){
        return Reception::where('login', $login)->first();
    }

    public function addReception($data){
        $reception = Reception::create($data);
        $reception->password = md5(md5($data['password']));
        $reception->save();
    }

    public function deleteReception($id){
        Reception::find($id)->delete();
    }

    public function updateReception($data){
        $reception = Reception::find($data['id']);
        $reception->phone = $data['phone'];
        $reception->login = $data['login'];
        $reception->password = md5(md5($data['password']));
        $reception->save();
    }






//    Hamshiralar
    public function getNurses(){
        return Nurse::orderBy('name')->get();
    }

    public function getNurse($login){
        return Nurse::where('login', $login)->first();
    }

    public function addNurse($data){
        $reception = Nurse::create($data);
        $reception->password = md5(md5($data['password']));
        $reception->save();
    }

    public function deleteNurse($id){
        Nurse::find($id)->delete();
    }

    public function updateNurse($data){
        $reception = Nurse::find($data['id']);
        $reception->phone = $data['phone'];
        $reception->login = $data['login'];
        $reception->password = md5(md5($data['password']));
        $reception->save();
    }





//    getEmployees
    public function getEmployees(){
        return Employee::orderBy('name')->get();
    }

    public function addEmployee($data){
        $user = new Employee;
        $user->name = $data['name'];
        $user->phone = $data['phone'];
        $user->save();
    }

    public function deleteEmployees($id){
        Employee::where('id', $id)->delete();
    }



    public function searchUsers($gender = 'all',$doctorId = 'all',$startDate = 'all',$endDate = 'all', $phone = 'phone')
    {
//        return [$gender,$doctorId,$startDate,$endDate];
        // Create a query builder to fetch users
        $query = User::query();

        // Filter users based on gender and doctor_id
        if ($gender != 'all') {
            $query->where('sex', $gender);
        }

        if ($doctorId != 'all') {
            $query->where('doctor', $doctorId);
        }

        // Filter users based on age range (birth date between start and end dates)
        if (($startDate != 'all') && ($endDate != 'all')) {
            $startDateTime = Carbon::createFromFormat('Y-m-d', $startDate)->startOfDay();
            $endDateTime = Carbon::createFromFormat('Y-m-d', $endDate)->endOfDay();

            $query->whereBetween('birth_date', [$startDateTime, $endDateTime]);
        }
        $query->where('status', 1);

        // Execute the query and fetch the users
        if ($phone != 'phone2'){
            $users = $query->get(['phone']);
        }
        else{
            $users = $query->get(['phone2 as phone']);
        }

        // Return the users to a view for display
        return $users;
    }

}
