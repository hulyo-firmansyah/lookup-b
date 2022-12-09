<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class UserPasswordRule implements Rule
{
    private $msg = 'Password must have character and number.';

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        //match whitespace
        $match = preg_match("/\s/", $value);
        if ($match) {
            $this->msg = "Password cannot contain whitespace.";
            return false;
        };

        $match = preg_match("/\w\d/", $value);

        return $match;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return $this->msg;
    }
}
