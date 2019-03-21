<?php

namespace TopviewDigital\LangSwitcher;

use Illuminate\Support\ServiceProvider;

class LangSwitcherServiceProvider extends ServiceProvider
{
    /**
     * @var array
     */
    protected $commands = [
        Console\InstallCommand::class,
        Console\PublishCommand::class,
    ];

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->commands($this->commands);
    }

    private function publishAssets()
    {
        $this->publishes(
            [
                __DIR__ . '/config/lang-switch.php' => config_path('lang-switch.php'),
            ]
        );
    }

    /**
     * {@inheritdoc}
     */
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__ . '/migration');
        if ($this->app->runningInConsole()) {
            $this->publishAssets();
        }
    }
}
