<?php

namespace App\Http\Requests\Data\User;

use App\Rules\UserPasswordRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class StoreUserRequest extends FormRequest
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
                    return true;
                }
            case 'admin': {
                    return false;
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
            'name' => ['required', 'min:5', 'max:255', Rule::unique('users')],
            'email' => ['required', 'email', Rule::unique('users')],
            'password' => ['required', 'min:4', 'max:255', new UserPasswordRule]
        ];
    }

    /**
     * After passs  validation
     */
    public function passedValidation()
    {
        $pass = bcrypt($this->password);
        $this['password'] = $pass;
    }
}
