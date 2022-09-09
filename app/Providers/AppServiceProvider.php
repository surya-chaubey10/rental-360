<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Schema::defaultStringLength(191);

        $this->app->singleton('device', function ($app) {
            return new \App\Classes\DeviceDetect;
        });

        $this->app->singleton('sms', function ($app) {
            return new \App\Classes\SMS;
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->setAppTimezone();

        $this->setSegments();

        $this->setApplicationScope();

        $this->setViewsPath();
    }

    protected function setAppTimezone()
    {
        $this->app->timezone = request()->header('timezone') ?? 'America/Edmonton';
    }

    protected function setSegments()
    {
        $this->segments = request()->segments();
    }

    protected function setApplicationScope()
    {
        if (!isset($this->segments[0])) {
            $this->setAppScope('front');
            return;
        }
        
        if ($this->segments[0] === config('app.super_admin')) {
            $this->setAppScope('admin');
        } else {
            $this->setAppScope('front');
        }
    }

    protected function setAppScope($scope = 'front')
    {
        $this->app->scope = $scope;
    }

    protected function setViewsPath()
    {
        if ($this->app->scope === 'admin') {
            config(['view.paths' => [resource_path('views/admin')]]);
        }

        if ($this->app->scope === 'front') {
            config(['view.paths' => [resource_path('views/front')]]);
        }
    }
}
