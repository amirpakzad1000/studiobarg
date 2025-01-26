<?php

namespace studiobarg\User\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class validMobile implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // بررسی شماره موبایل با Regex
        if (!preg_match('/^\+98\d{10}$/', $value)) {
            $fail(__('فیلد :attribute باید یک شماره موبایل معتبر با فرمت +98 باشد.'));
        }
    }
}
