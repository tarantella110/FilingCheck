<?php

namespace Tarantella110\FilingCheck;

use Illuminate\Support\ServiceProvider;

class FilingCheckServiceProvider extends ServiceProvider
{
    /**
     * 服务提供者加是否延迟加载.
     *
     * @var bool
     */
    protected $defer = true; // 延迟加载服务

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        // 因为延迟加载 所以要定义 provides 函数 具体参考laravel 文档
        return ['FilingCheck'];
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        // 单例绑定服务
        $this->app->singleton('FilingCheck', function ($app) {
            return new FilingCheck($app['session'], $app['config']);
        });

    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__ . '/views', 'FilingCheck'); // 视图目录指定
        $this->publishes([
            __DIR__ . '/views' => base_path('resources/views/vendor/FilingCheck'),  // 发布视图目录到resources 下
            __DIR__ . '/config/filingCheck.php' => config_path('filingCheck.php'), // 发布配置文件到 laravel 的config 下
        ]);

    }
}
