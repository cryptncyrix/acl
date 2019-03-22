<?php declare(strict_types=1);
namespace cyrixbiz\acl\Console\commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Validator;

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

    /*
     * @var object
     */
    protected $bar;

    /**
     * AclCommand constructor.
     */
    public function __construct()
    {
        $this->user = config('auth.providers.users.model');
        $this->role = config('acl.model.roles');
        parent::__construct();
    }

    /**
     * Handle the Command
     */
    public function handle()
    {

        $this->startBar(6);

        // Create the Auth from Laravel
        $this->setAuth();
        $this->setAdvance();

        // Create the Routes
        $this->setRoutes();
        $this->setAdvance();

        // Publish the Config, View- and Language-Files
        $this->setResourceFiles();
        $this->setAdvance();

        // Create the Tables
        $this->setTables();
        $this->setAdvance();

        // Create the Seeds
        $this->setSeeds();
        $this->setAdvance();

        // Create an Admin
        if($this->setAdmin() === false)
        {
            return false;
        }

        $this->closeBar();
    }

    /**
     * Create the Laravel Auth
     * @return int|null
     */
    public function setAuth() : ?int
    {
        if ($this->confirm(__('AclLang::commands.auth'))) {
            return $this->call('make:auth');
        }

        return $this->info(__('AclLang::commands.auth_jump'));
    }

    public function setRoutes()
    {
        file_put_contents(
            base_path('routes/web.php'),
            file_get_contents(__DIR__.'../../stubs/routes.stub'),
            FILE_APPEND
        );

        return $this->info('Routes Created');
    }

    /**
     * Copy the Config File
     * @return int
     */
    public function setResourceFiles() : int
    {
        $this->info(__('AclLang::commands.config'));

        return $this->call('vendor:publish', [
            '--provider' => \cyrixbiz\acl\AclServiceProvider::class
        ]);
    }

    /**
     * Migrate the Tables
     * @return int
     */
    public function setTables() : int
    {
        $this->info(__('AclLang::commands.tables'));
        return $this->call('migrate');
    }

    /**
     * Fill the Resources
     * @return int
     */
    public function setSeeds() : int
    {
        $this->info(__('AclLang::commands.seeds'));
        return $this->call('db:seed', [
            '--class' => \cyrixbiz\acl\database\seeds\AclSeeder::class
        ]);
    }

    /**
     * First Admin - SuperAdmin
     * @return int
     */
    public function setAdmin() : ?bool
    {
        $this->info(__('AclLang::commands.admin'));
        $admin = new $this->user;
        $role  = new $this->role;
        $admin->name = $this->ask(__('AclLang::commands.name'));
        $admin->email =  $this->ask(__('AclLang::commands.email'));
        $password = $this->ask(__('AclLang::commands.password'));
        $admin->password = $password;

        $validator = Validator::make([
            'name' => $admin->name,
            'email' => $admin->email,
            'password' => $password,
        ], [
            'name' => ['required', 'min:5'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/']
        ]);


        if ($validator->fails()) {
            $this->info(__('AclLang::commands.admin_fail'));

            foreach ($validator->errors()->all() as $error) {
                $this->error($error);
            }
            return false;
        }

        $admin->save();
        return $admin->find($admin->id)->roles()->attach($role->whereName('Admin')->first()->id);
    }

    /**
     * @param int $max
     * @return bool|null
     */
    public function startBar(int $max) : ?bool
    {
        $this->bar = $this->output->createProgressBar($max);
        return $this->bar->start();
    }

    /**
     * Status Bar next Step
     * @return bool|null
     */
    public function setAdvance() : ?bool
    {
        return $this->bar->advance();
    }

    /**
     * Close the Statusbar
     * @return bool|null
     */
    public function closeBar() : ?bool
    {
        $this->bar->finish();
        return $this->info(__('AclLang::commands.success'));
    }
}