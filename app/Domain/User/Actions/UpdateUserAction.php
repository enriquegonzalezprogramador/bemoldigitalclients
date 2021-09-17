<?php

namespace Domain\User\Actions;

use Domain\User\Models\User;

use Domain\User\DataTransferObjects\UserData;

final class UpdateUserAction {

    public function __invoke(UserData $userData, User $user) {

     $user->update([
        'first_name' => $userData->first_name,
        'last_name' => $userData->last_name,
        'email' => $userData->email,
        'password' => bcrypt($userData->password),
        'type' => $userData->type,
        'confirmed' => $userData->confirmed    
    ]);
}

}