<?php

namespace App\Services;

use App\Models\Reception;
use App\Repositories\ReceptionRepository;
use Symfony\Component\HttpFoundation\Response;

class ReceptionService
{
    public function __construct(protected ReceptionRepository $receptionRepository,)
    {
    }

    public function checkReception($login, $password)
    {
        $res = $this->receptionRepository->getReception($login, $password);
        if (count($res) != 0){
            session()->put('reception',$res[0]->id);
            session()->put('reception_name', $res[0]->name);
            return 1;
        }
        else{
            return 0;
        }
    }

    public function getBlocks(){
        return $this->receptionRepository->getBlocks();
    }

    public function logout(){
        session()->flush();
    }
}
