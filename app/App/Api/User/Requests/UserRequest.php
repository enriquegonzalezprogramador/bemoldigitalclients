<?php

namespace Desing\Api\User\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest {

    public function rules(): array  {
        

        return [
            'first_name' => ['required', 'string'],
            'last_name' => ['required', 'string'],
            'email' => ['required', 'string'],
            'password' => ['required', 'string'],
            'confirmed' => [ 'string'],
            'type' => ['required', 'string'],
            
        ];
    }
}

