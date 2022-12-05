<?php

namespace App\Http\Requests\Data\Brand;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreBrandRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $role = auth()->user()->role;
        switch ($role) {
            case 'dev': {
                }
            case 'owner': {
                }
            case 'admin': {
                    return true;
                }
            default: {
                    return false;
                }
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'unique:brands'],
            // 'details' => ['required']
        ];
    }

    /**
     * Catch failed validation
     */
    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response([
            'message'   => 'Bad Request',
            'data'      => $validator->errors()
        ], 400));
    }
}
