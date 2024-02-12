<?php

namespace App\Domain\Shared\Auth\DTO;

use App\Domain\Shared\DTO\DataTransferObject;
use Illuminate\Support\Facades\Hash;

class UserDTO extends DataTransferObject
{

    public string $name;

    public string $mobile_no;

    public string $email;

    public string $password;

    /**
     * @inheritDoc
     */
    public static function fromRequest(array $request): DataTransferObject
    {
        return new self([
            'name' => $request['name'],
            'mobile_no' => $request['mobile_no'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ]);
    }
}
