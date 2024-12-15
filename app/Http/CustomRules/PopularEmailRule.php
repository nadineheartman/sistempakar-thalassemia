<?php

namespace App\Http\CustomRules;

use Illuminate\Contracts\Validation\Rule;

class PopularEmailRule implements Rule
{
    protected $popularProviders = [
        'yahoo.co.id',
        'mail.unpad.ac.id',
        'unpad.ac.id',
        'gmail.com',
        'yahoo.com',
        'outlook.com',
        'icloud.com',
        'aol.com',
        'zoho.com',
        'protonmail.com',
        'mail.com',
        'yandex.com',
        'gmx.com',
    ];

    public function passes($attribute, $value)
    {
        $emailDomain = explode('@', $value)[1];

        return in_array($emailDomain, $this->popularProviders);
    }

    public function message()
    {
        return 'The :attribute must be a valid email.';
    }
}
