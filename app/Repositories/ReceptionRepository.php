<?php

namespace App\Repositories;

use App\Interfaces\ReceptionRepositoryInterface;
use App\Models\Reception;
use Illuminate\Support\Facades\DB;

class ReceptionRepository implements ReceptionRepositoryInterface
{

    public function getReception($login, $password)
    {
        $reception = Reception::where('login', $login)
                        ->where('password', $password)
                        ->get();
//        $reception = DB::table('receptions')
//            ->where('login',$login)
//            ->where('password', $password)
//            ->get();
        return $reception;
    }
}
