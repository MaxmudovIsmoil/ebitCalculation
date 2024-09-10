<?php

namespace App\Http\Requests\Admin;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UserUpdateRequest extends FormRequest
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
            'name' => 'required',
            'email' => 'required|string|unique:users,email,'.$this->id,
            'phone' => 'required|max:9|min:9|unique:users,phone,'.$this->id,
            'username' => 'required|unique:users,username,'.$this->id,
            'status' => 'required',
            'language' => 'required',
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
