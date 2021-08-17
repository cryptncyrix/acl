<?php declare(strict_types=1);
namespace cyrixbiz\acl\Console\commands;

use cyrixbiz\acl\Exceptions\Command\CommandArgumentNotExistsException;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Validator as Validation;

/**
 * Class AclCommand
 * @package cyrixbiz\acl\commands
 */
class AclCommand extends Command
{
    /**
     * @var string
     */
    protected $signature = 'make:acl {action?} {--admin=*}';

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
        $this->checkConnection();

        $this->user = config('auth.providers.users.model');
        $this->role = config('acl.model.roles');
        parent::__construct();
    }

    /**
     * Handle the Command
     */
    public function handle()
    {
        // Install a Single Method
        if($this->single())
        {
            return true;
        }

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
     * Install a Single Method
     * @return bool
     */
    public function single() : bool
    {
        if(!is_null($this->argument('action')))
        {
            throw_unless(method_exists($this, $this->argument('action')), CommandArgumentNotExistsException::class);
            $this->{$this->argument('action')}();
            return true;
        }
        return false;
    }

    /**
     * Create the Laravel Auth
     * @return int|null
     */
    public function setAuth() : ?int
    {
        if ($this->confirm(__('AclLang::commands.auth'))) {
            return $this->call('ui bootstrap --auth');
        }
        return $this->info(__('AclLang::commands.auth_jump'));
    }

    /**
     * Set the Routes to web.php
     * @return bool|null
     */
    public function setRoutes() : ?bool
    {
        $routesContents = file_get_contents(base_path('routes/web.php'));
        $stubsContents = file_get_contents(__DIR__.'../../stubs/routes.stub');
        if(!strpos($routesContents, $stubsContents))
        {
            file_put_contents(
                base_path('routes/web.php'),
                $stubsContents,
                FILE_APPEND
            );
            return $this->info(__('AclLang::commands.route'));
        }
        return $this->info(__('AclLang::commands.route_exists'));
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
     * Create an Admin
     * @return int
     */
    public function setAdmin() : ?bool
    {

        $this->info(__('AclLang::commands.admin'));
        $admin = new $this->user;
        $role  = new $this->role;

        $admin->name = array_key_exists(0, $this->option('admin')) ? $this->option('admin')[0] : $this->ask(__('AclLang::commands.name'));
        $admin->email =  array_key_exists(0, $this->option('admin')) ? $this->option('admin')[1] : $this->ask(__('AclLang::commands.email'));
        $password = array_key_exists(0, $this->option('admin')) ? $this->option('admin')[2] : $this->ask(__('AclLang::commands.password'));
        $admin->password = $password;

        $validator = $this->validateInput($admin->name, $admin->email, $password);

        if ($validator->fails()) {
            $this->info(__('AclLang::commands.admin_fail'));
            foreach ($validator->errors()->all() as $error) {
                $this->error($error);
            }
            return false;
        }

        $admin->save();
        $admin->find($admin->id)->roles()->attach($role->whereName('Admin')->first()->id);
        $this->info(__('AclLang::commands.admin_success'));
        return true;
    }

    /**
     * Check the Database Connection is active
     * @return bool
     */
    protected function checkConnection() : bool
    {
        if(DB::connection()->getDatabaseName())
        {
            return true;
        }
        exit(__('AclLang::commands.connection'));
    }

    /**
     * Validate the Adnin Input
     * @param $name
     * @param $email
     * @param $password
     * @return Validation
     */
    protected function validateInput($name, $email, $password) : Validation
    {
        return Validator::make(
            [
                'name' => $name,
                'email' => $email,
                'password' => $password,
            ],
            [
                'name' => ['required', 'min:5'],
                'email' => ['required', 'email', 'unique:users,email'],
                'password' => ['required', 'regex:/(?=.{8,})((?=.*\d)(?=.*[a-z])(?=.*[A-Z])|(?=.*\d)(?=.*[a-zA-Z])(?=.*[\W_])|(?=.*[a-z])(?=.*[A-Z])(?=.*[\W_])).*/']
            ],
            [
                'name.required' => __('AclLang::validation.name.required'),
                'name.min' => __('AclLang::validation.name.min'),
                'email.required' => __('AclLang::validation.email.required'),
                'email.email' => __('AclLang::validation.email.email'),
                'email.unique' => __('AclLang::validation.email.unique'),
                'password.required' => __('AclLang::validation.password.required'),
                'password.regex' => __('AclLang::validation.password.regex'),
            ]
        );
    }

    /**
     * Start the Status Bar
     * @param int $max
     * @return bool|null
     */
    protected function startBar(int $max) : ?bool
    {
        $this->bar = $this->output->createProgressBar($max);
        return $this->bar->start();
    }

    /**
     * Status Bar next Step
     * @return bool|null
     */
    protected function setAdvance() : ?bool
    {
        return $this->bar->advance();
    }

    /**
     * Close the Statusbar
     * @return bool|null
     */
    protected function closeBar() : ?bool
    {
        $this->bar->finish();
        return $this->info(__('AclLang::commands.success'));
    }
}