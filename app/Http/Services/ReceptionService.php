<?php

namespace App\Http\Services;

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
            session()->put('reception',1);
            return 1;
        }
        else{
            return 0;
        }
    }
}
