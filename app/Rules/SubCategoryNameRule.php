<?php

namespace App\Rules;

use App\Models\SubCategory;
use Illuminate\Contracts\Validation\Rule;

class SubCategoryNameRule implements Rule
{
    private $ci;
    private $sci;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(Int $category_id, $id = null)
    {
        $this->ci = $category_id;
        $this->sci = $id;
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
        //looking for same category_id
        //if already same reject
        $sc = SubCategory::where('category_id', $this->ci)->get();
        $sci = intval($this->sci);
        $isContain = $sc->contains(function ($v) use ($value, $sci) {
            if ($sci) {
                if ($v->id !== $sci) {
                    return strtolower($v->name) === strtolower($value);
                }
            } else {
                return strtolower($v->name) === strtolower($value);
            }
        });

        return !$isContain;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return ':attribute already taken.';
    }
}
