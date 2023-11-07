<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class GetUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() && $this->user()->role == 'admin';
    }

    public function rules(): array
    {
        return [
            //
        ];
    }
}
