<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Storage;

class B64ImageRule implements Rule
{
    private $msg = ':attr';
    private $mime = "jpeg|png|bmp|jpg|gif";
    private $maxSize = 10240;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($mime = null, $maxSize = null)
    {
        if ($mime) {
            $this->mime = $mime;
        }
        if ($maxSize) {
            $this->maxSize = $maxSize;
        }
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
        $image = base64_decode($value);

        $f = finfo_open();
        $mime = finfo_buffer($f, $image, FILEINFO_MIME_TYPE);
        $ext = explode("/", $mime)[1];

        //Validate mime
        if (!$this->validateMime($ext)) {
            $this->msg = 'Image type must be type of ' . $this->mime . ', Received type ' . $ext . '.';

            return false;
        }

        //Validate size
        $imageName = uniqid() . "." . $ext;
        Storage::put('tempdir/' . $imageName, $image);
        if (!$this->validateSize('tempdir/' . $imageName)) {
            $this->msg = 'Image size must not be greater than ' . $this->maxSize . 'KB.';

            return false;
        }

        return true;
    }

    private function validateMime(String $ext)
    {
        $match = preg_match("/" . $this->mime . "/", $ext);

        return $match > 0;
    }

    private function validateSize($path)
    {
        $size = Storage::size($path);
        $size = round($size / 1024);
        Storage::delete($path);

        return $size < $this->maxSize;
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
