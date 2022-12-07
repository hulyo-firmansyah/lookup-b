<?php

namespace App\Http\Requests\Data\Product;

use App\Rules\ProductSpecRule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Collection;
use Illuminate\Validation\Rule;

class StoreProductRequest extends FormRequest
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
            'product_code' => ['required', Rule::unique('products'), 'min:2', 'max:10'],
            'product_name' => ['required', Rule::unique('products'), 'min:3', 'max:300'],
            'qty' => ['required', 'numeric'],
            'price' => ['required', 'numeric', 'digits_between:2,9'],
            'brand_id' => ['required', 'numeric'],
            'supplier_id' => ['required', 'numeric'],
            'warehouse_id' => ['required', 'numeric'],
            'unit_id' => ['required', 'numeric'],
            'category_id' => ['required', 'numeric'],
            'sub_category_id' => ['required', 'numeric'],
            'images.*' => ['mimes:jpeg,png,bmp,jpg,gif', 'max:10240', 'image'],
            'specs' => ['json', new ProductSpecRule]
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

    /**
     * After passs  validation
     */
    public function passedValidation()
    {
        if ($this->specs) {
            $collection = new Collection([]);
            $rawSpecs = json_decode($this->specs);
            foreach ($rawSpecs as $rawSpec) {
                $collection->push($rawSpec);
            }

            $this->specs = $collection;
        }
    }
}
