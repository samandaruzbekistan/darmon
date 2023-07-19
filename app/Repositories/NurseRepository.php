<?php

namespace App\Repositories;

use App\Models\Nurse;
use App\Models\Reception;
use App\Models\User;


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

}
