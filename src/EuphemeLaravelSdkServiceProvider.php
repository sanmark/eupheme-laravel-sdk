<?php

namespace Sanmark\EuphemeLaravelSdk;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class EuphemeLaravelSdkServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {

        $this -> app -> bind(iUserHelper::class, config('eupheme-laravel-sdk.user_helper', UserHelper::class));

        $userHelper = app(iUserHelper::class);


        View ::composer('eupheme-laravel-sdk::single-comment', function ($view) use ($userHelper) {
            View ::share('userHelper', $userHelper);
            $loggedUserID = $userHelper -> getAuthUserID();
            View ::share('authUserID', $loggedUserID);
        });

        $this -> loadRoutesFrom(__DIR__ . '/routes.php');

        $this -> publishes([__DIR__ . '/eupheme-laravel-sdk.php' => config_path('eupheme-laravel-sdk.php')]);

        $this -> loadViewsFrom(__DIR__ . '/views', 'eupheme-laravel-sdk');


        View ::composer('eupheme-laravel-sdk::comments', function (\Illuminate\View\View $view) use ($userHelper) {
            $loggedUserID = $userHelper -> getAuthUserID();
            $viewData = $view -> getData();

            $extRef = isset($viewData['eupheme_ext_ref']) ? $viewData['eupheme_ext_ref'] : null;
            $instance = isset($viewData['eupheme_instance']) ? $viewData['eupheme_instance'] : null;

            $euphemeService = new EuphemeService($instance);

            $comments = $euphemeService -> getComments($extRef, $instance);
            View ::share('title', $extRef);
            View ::share('comments', $comments);
            View ::share('authUserID', $loggedUserID);
        });
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
    }
}
