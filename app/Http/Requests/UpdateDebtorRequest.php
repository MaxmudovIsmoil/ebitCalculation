<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

class UpdateDebtorRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
//        Log::info($this);
        return [
            'id' => 'required',
            'name' => 'required|string|max:255',
            'phone' => 'required|size:9|unique:debtors,phone,'.$this->id,
//            'phone' => ['required', Rule::unique('debtors')->ignore($this->phone)],
            'status' => 'required|min:1|max:1',
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
