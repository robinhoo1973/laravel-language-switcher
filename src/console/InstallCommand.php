<?php

namespace TopviewDigital\LangSwitcher\Console;

use Illuminate\Console\Command;
use TopviewDigital\LangSwitcher\Model\LangSwitcher;

class InstallCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'lang-switch:install';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install the language switcher tables accoding to config';
    /**
     * Install directory.
     *
     * @var string
     */
    protected $directory = '';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $this->initDatabase();
    }

    /**
     * Create tables and seed it.
     *
     * @return void
     */
    public function initDatabase()
    {
        $this->call('migrate');
        LangSwitcher::firstOrCreate(['class' => 'Auth', 'method' => 'user', 'middleware' => 'web']);
    }
}
