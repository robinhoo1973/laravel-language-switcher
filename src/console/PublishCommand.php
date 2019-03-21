<?php

namespace TopviewDigital\LangSwitcher\Console;

use Illuminate\Console\Command;

class PublishCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'lang-switch:publish {--force}';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "publish translation helper's assets, configuration, config and migration files. If you want overwrite the existing files, you can add the `--force` option";

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $force = $this->option('force');
        $options = ['--provider' => 'TopviewDigital\LangSwitcher\LangSwitcherServiceProvider'];
        if ($force == true) {
            $options['--force'] = true;
        }
        $this->call('vendor:publish', $options);
    }
}
