<?php

namespace App\Http\Requests\Data\Supplier;

use App\Models\Supplier;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class UpdateSupplierRequest extends FormRequest
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

    public function prepareForValidation()
    {
        $id = intval($this->supplier);
        $supplier = Supplier::find($id);

        if (!$supplier) {
            throw new HttpResponseException(response([
                'message' => 'Supplier Not Found',
                'data' => null
            ], 404));
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
            'name' => ['required', 'max:255', Rule::unique('suppliers')->ignore($this->supplier)],
            'phone' => 'integer|digits_between:2,15',
            'email' => 'nullable|email',
            'address' => 'required',
            // 'details' => ''
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response([
            'message'   => 'Bad Request',
            'data'      => $validator->errors()
        ], 400));
    }
}
