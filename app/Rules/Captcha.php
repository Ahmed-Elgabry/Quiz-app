<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use ReCaptcha\ReCaptcha;
use Illuminate\Support\Facades\App;
class Captcha implements Rule
{
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
        //
        $recaptcha = new ReCaptcha('6LdLuBYaAAAAAPQ-x572S5LwuMIEmVpjO12lZesn');
        $response = $recaptcha->verify($value,$_SERVER['REMOTE_ADDR']);
        return $response->isSuccess();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        if(App::isLocale('ar')){
            return 'يرجى ملء رمز التحقق للمتابعة.';
        }else{
            return 'Please fill the Captcha to continue.';
        }

    }
}
