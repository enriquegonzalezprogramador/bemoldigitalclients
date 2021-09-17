<?php

namespace Domain\User\DataTransferObjects;

use Desing\Api\User\Requests\UserRequest;

use Spatie\DataTransferObject\DataTransferObject;

class UserData extends DataTransferObject {

/** @var string */

public $first_name;

/** @var string */

public $last_name;

/** @var string */

public $email;

/** @var string */

public $password; 

/** @var boolean */

public $confirmed;

/** @var string */

public $type;




public static function fromRequest(UserRequest $userRequest): UserData {

    return new Self([
        'first_name' => $userRequest['first_name'],
        'last_name' =>  $userRequest['last_name'],
        'email' => $userRequest['email'],
        'password' => $userRequest['password'],
        'confirmed' => true,
        'type' => $userRequest['type'],
        
    ]);
}

}