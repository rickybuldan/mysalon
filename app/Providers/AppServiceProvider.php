<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Schema::defaultStringLength(191);
        Validator::extend('image64', function ($attribute, $value, $parameters, $validator) {
            $type = explode('/', explode(':', substr($value, 0, strpos($value, ';')))[1])[1];
            if (in_array($type, $parameters)) {
                // Check if the image size is less than or equal to 2MB (2097152 bytes)
                $imageData = base64_decode(substr($value, strpos($value, ',') + 1));
                return strlen($imageData) <= 2097152;
            }
            return false;
        });
        
        Validator::replacer('image64', function ($message, $attribute, $rule, $parameters) {
            $maxSize = '2MB';
            return str_replace([':values', ':size'], [join(", ", $parameters), $maxSize], $message);
        });
        

    }
}
