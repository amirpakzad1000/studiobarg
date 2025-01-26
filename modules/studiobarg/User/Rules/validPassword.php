<?php

namespace studiobarg\User\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class validPassword implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!preg_match('/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$ %^&*-]).{8,}$/', $value)) {
            $fail(__('رمز عبور باید حداقل ۸ کاراکتر داشته باشد و شامل حروف بزرگ، حروف کوچک، اعداد و نمادهای خاص باشد..'));
        }
    }
}
