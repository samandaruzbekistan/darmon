<?php

namespace App\Repositories;

use App\Models\Block;
use App\Models\Nurse;
use App\Models\Process;
use App\Models\Reception;
use App\Models\User;
use App\Models\Ward;


class NurseRepository
{
    public function getNurse($login, $password)
    {
        $nurse = Nurse::where('login', $login)
            ->where('password', md5(md5($password)))
            ->get();
        return $nurse;
    }

    public function getPatientById($id){
        $user = User::find($id);
        return $user;
    }

    public function updatePatient($data){
        $user = User::find($data['user_id']);
        $user->phone = $data['phone'];
        $user->phone2 = $data['phone2'];
        $user->departure_date = $data['departure_date'];
        $user->block_id = $data['block_id'];
        $user->ward_id = $data['ward_id'];
        $user->change_nurse = session('nurse_name');
        $user->save();
        return $user;
    }

    public function getBlock($id){
        return Block::find($id);
    }

    public function decrementBlock($id){
        $block = Block::find($id);
        $block->users_count = $block->users_count - 1;
        $block->filled_prosent = ($block->users_count)*100/$block->space_count;
        $block->save();
    }

    public function incrementBlock($id){
        $block = Block::find($id);
        $block->users_count = $block->users_count + 1;
        $block->filled_prosent = ($block->users_count)*100/$block->space_count;
        $block->save();
    }

    public function decrementWard($id){
        $ward = Ward::find($id);
        if (($ward->users_count - 1) == 0) $ward->status = 0;
        $ward->users_count = $ward->users_count - 1;
        $ward->save();
    }

    public function incrementWard($id){
        $ward = Ward::find($id);
        if ($ward->space_count == ($ward->users_count + 1)) $ward->status = 2;
        if ($ward->status == 0) $ward->status = 1;
        $ward->users_count = $ward->users_count + 1;
        $ward->save();
    }

    public function getWard($id){
        return Ward::find($id);
    }

    public function addDays($currentDate, $endDate, $patient, $block, $ward, $phone){
        while ($currentDate <= $endDate) {
            $row = [
                'user_id' => $patient->id,
                'user_name' => $patient->name,
                'doctor' => $patient->doctor,
                'date' => $currentDate,
                'block_letter' => $block->letter,
                'ward_number' => $ward->number,
                'type' => 1, // day
                'phone' => $phone,
                'status' => 0, // or any default status
            ];

            $rowsToInsert[] = $row;

            $row = [
                'user_id' => $patient->id,
                'user_name' => $patient->name,
                'doctor' => $patient->doctor,
                'date' => $currentDate,
                'block_letter' => $block->letter,
                'ward_number' => $ward->number,
                'type' => 2, // day
                'phone' => $phone,
                'status' => 0, // or any default status
            ];

            $rowsToInsert[] = $row;

            // Move to the next day
            $currentDate = date('Y-m-d', strtotime($currentDate . ' +1 day'));
        }

        Process::insert($rowsToInsert);
    }

    public function removePatient($user_id){
        $user = User::find($user_id);
        $user->status = 1;
        $user->remove_nurse = session('nurse_name');
        $user->save();
    }

    public function remove_process($user_id){
        Process::where('user_id', $user_id)->where('date','>=', date('Y-m-d'))->delete();
    }
}
