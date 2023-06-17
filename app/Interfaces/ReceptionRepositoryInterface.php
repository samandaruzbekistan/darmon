<?php

namespace App\Interfaces;

interface ReceptionRepositoryInterface
{
    public function getReception(string $login, string $password);
}
