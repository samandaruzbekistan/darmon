<?php

namespace App\Repositories;

use App\Models\Doctor;
use App\Models\Process;

class DoctorRepository
{
//  Get doctor
    public function getDoctor($id){
        return Doctor::find($id);
    }

//    Get patients by block letter
    public function getPatients($block_letter, $doctor_name){
        return Process::where('block_letter', $block_letter)
            ->where('doctor', $doctor_name)
            ->where('date', date('Y-m-d'))
            ->get();
    }
}
