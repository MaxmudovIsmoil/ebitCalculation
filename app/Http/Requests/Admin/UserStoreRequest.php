<?php

namespace App\Http\Requests\Admin;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UserStoreRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'roadId' => 'sometimes',
            'instanceId' => 'required',
            'position' => 'required',
            'name' => 'required|string|max:255',
            'email' => 'required|string|unique:users,email',
            'phone' => 'required|max:9|min:9|unique:users,phone',
            'username' => 'required|string|unique:users,username',
            'status' => 'required',
            'canCreateOrder' => 'required',
            'showBuilder' => 'required',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success'  => false,
            'message'  => 'Validation errors',
            'errors'   => $validator->errors()
        ]));
    }
}
