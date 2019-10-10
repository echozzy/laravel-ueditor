<?php
/** .-------------------------------------------------------------------
 * |      Site: www.zhouzy365.com
 * |      Date: 2019/9/10 下午3:13
 * |    Author: zzy <348858954@qq.com>
 * '-------------------------------------------------------------------*/

namespace Zzy\LaravelUEditor;

use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\ServiceProvider;

/**
 * Class UEditorServiceProvider.
 */
class UEditorServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @param \Illuminate\Routing\Router $router
     */
    public function boot(Router $router)
    {
        $this->loadViewsFrom(__DIR__.'/views', 'ueditor');
        $this->loadTranslationsFrom(__DIR__.'/translations', 'ueditor');

        $this->publishes([
            __DIR__.'/config/ueditor.php' => config_path('ueditor.php'),
        ], 'config');

        $this->publishes([
            __DIR__.'/assets/ueditor' => public_path('vendor/ueditor'),
        ], 'assets');

        $this->publishes([
            __DIR__.'/views' => base_path('resources/views/vendor/ueditor'),
            __DIR__.'/translations' => base_path('resources/lang/vendor/ueditor'),
        ], 'resources');

        $this->registerRoute($router);
    }

    /**
     * Register any application services.
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/config/ueditor.php', 'ueditor');
        $this->app->singleton('ueditor.storage', function ($app) {
            return new StorageManager(Storage::disk($app['config']->get('ueditor.disk', 'public')));
        });
    }

    /**
     * Register routes.
     *
     * @param $router
     */
    protected function registerRoute($router)
    {
        if (!$this->app->routesAreCached()) {
            $router->group(array_merge(['namespace' => __NAMESPACE__], config('ueditor.route.options', [])), function ($router) {
                $router->any(config('ueditor.route.name', '/ueditor/server'), 'UEditorController@serve');
            });
        }
    }
}
