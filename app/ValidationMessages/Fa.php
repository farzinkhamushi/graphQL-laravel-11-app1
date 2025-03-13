<?php 

namespace App\ValidationMessages;

class Fa{
    private static $m = [
        'name.required' => 'نام الزامی است.',
        'name.string' => 'نام باید یک متن باشد.',
        'email.required' => 'ایمیل الزامی است.',
        'email.email' => 'فرمت ایمیل نامعتبر است.',
        'email.unique' => 'این ایمیل قبلاً ثبت شده است.',
        'password.required' => 'رمز عبور الزامی است.',
        'password.min' => 'رمز عبور باید حداقل 8 کاراکتر باشد.',
    ];
    public static function getAllErrorMessage()
    {
        return self::$m;
    }
}