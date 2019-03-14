<?php declare(strict_types=1);
namespace cyrixbiz\acl\commands;

use Illuminate\Console\Command;

/**
 * Class AclCommand
 * @package cyrixbiz\acl\commands
 */
class AclCommand extends Command
{
    /**
     * @var string
     */
    protected $signature = 'make:acl';

    /**
     * @var string
     */
    protected $description = 'Install the Acl';

    /**
     * AclCommand constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Handle the Command
     */
    public function handle()
    {

        $bar = $this->output->createProgressBar(4);
        $bar->start();
        if ($this->confirm(__('AclLang::commands.auth'))) {
            $this->call('make:auth');
        }
        else
        {
            $this->info(__('AclLang::commands.auth_jump'));
        }
        $bar->advance();
        if ($this->confirm(__('AclLang::commands.config'))) {

            $this->call('vendor:publish', [
                '--provider' => \cyrixbiz\acl\AclServiceProvider::class
            ]);
        } else
        {
            $this->info(__('AclLang::commands.config_jump'));
        }
        $bar->advance();

        $this->info(__('AclLang::commands.tables'));
        $this->call('migrate');
        $bar->advance();
        $this->info(__('AclLang::commands.seeds'));
        $this->call('db:seed', [
            '--class' => \cyrixbiz\acl\database\seeds\AclSeeder::class
        ]);
        $bar->finish();
        $this->info(__('AclLang::commands.success'));
    }

}