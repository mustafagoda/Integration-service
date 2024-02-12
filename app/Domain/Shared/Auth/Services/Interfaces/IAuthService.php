<?php

namespace App\Domain\Shared\Auth\Services\Interfaces;

interface IAuthService
{
    public function registerUser(array $requestData);

    public function loginUser(array $requestData);
}
