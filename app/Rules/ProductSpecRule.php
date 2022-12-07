<?php

namespace App\Rules;

use App\Models\Spec;
use Illuminate\Contracts\Validation\Rule;

class ProductSpecRule implements Rule
{

    private $msg = ':attribute should be valid type.';

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
        if (!$value) return true;

        $v = json_decode($value);
        // Data must be an array
        if (!is_array($v)) {
            return false;
        }

        foreach ($v as $spec) {
            if (!$spec->spec || $spec->spec === "") {
                return false;
            }
            if (!$spec->value || $spec->value === "") {
                return false;
            }

            if (is_int($spec->spec)) {
                //Check spec id is exist on db
                $specRecord = Spec::find($spec->spec);
                if (!$specRecord) return false;
            } else {
                $specRecord = Spec::where('spec', '=', $spec->spec)->first();
                if ($specRecord) {
                    $this->msg = $spec->spec . " has already been taken.";
                    return false;
                }
            }
        }

        return true;
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
