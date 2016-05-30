<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Sasik\SmscGateway\SMSGateway;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        $this->app->bind(SMSGateway::class, function() {
            $login = env('SMS_LOGIN');
            $pass = env('SMS_PASSWORD');
            return new SMSGateway(['login' => $login, 'pass' => $pass]);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
