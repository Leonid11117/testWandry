<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class NameLineCountRule implements ValidationRule
{
    protected $maxLines;

    public function __construct($maxLines)
    {
        $this->maxLines = $maxLines;
    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $lines = explode(PHP_EOL, $value);

        if (count($lines) > $this->maxLines) {
            $fail("The $attribute must be limited to $this->maxLines lines.");
        }
    }
}
