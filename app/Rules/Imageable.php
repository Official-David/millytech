<?php

namespace App\Rules;

use Intervention\Image\Image;
use Illuminate\Contracts\Validation\Rule;
use Intervention\Image\ImageManagerStatic;

class Imageable implements Rule
{

    private $extensions = [];
    private Image $image;
    private string $mime;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($params = [])
    {
        $this->extensions = $params;
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
        try {
            return $this->validate($value);
        } catch (\Throwable $th) {
            return false;
        }

    }

    private function createImage(string $fileString)
    {
        $this->image = ImageManagerStatic::make($fileString);
        return $this;
    }

    private function getMimeType()
    {
        $this->mime = $this->image->mime();
        return $this;
    }

    private function getExtension(): string
    {
        return explode('/', $this->mime)[1];
    }

    private function validate($imageString): bool
    {
        return in_array(
            $this->createImage($imageString)
                ->getMimeType()
                ->getExtension(),
            $this->extensions
        );
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Provide a valid image, only ' . implode(', ', $this->extensions) . ' are supported';
    }
}
