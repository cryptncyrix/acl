<?php declare(strict_types=1);
namespace cyrixbiz\acl;
use cyrixbiz\acl\Services\AclService;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

/**
 * Class AclServiceProvider
 * @package cyrixbiz\acl
 */
class AclServiceProvider extends ServiceProvider {

    /**
     * @return void
     */
    public function boot()
    {
        include_once __DIR__.'/Helper/helpers.php';

        /*
         * Load the Routes from the Package
         */
        $this->loadRoutesFrom(__DIR__.'/routes/web.php');
        /*
         * Load the Views from the Package
         */
        $this->loadViewsFrom(__DIR__.'/resources/views', 'AclView');

        /*
         * Load the Translation from the Package
         */
        $this->loadTranslationsFrom(__DIR__.'/resources/lang', 'AclLang');

        /*
         * Load the Migrations from the Package
         */
        $this->loadMigrationsFrom(__DIR__.'/Database/migrations');

        /*
         * Load Blade Extensions
         */
        $this->setBladeVariables();

        /*
         * Publish Config
         */
        $this->publishes([
            __DIR__ . '/config/acl.php' => config_path('acl.php'),
        ]);

        $this->commands([\cyrixbiz\acl\commands\AclCommand::class]);
    }

    /**
     * Register the acl services.
     *
     * @return void
     */
    public function register()
    {
        // Load Config File
        $this->mergeConfigFrom(

            __DIR__ . '/config/acl.php' , 'acl'
        );

        $this->app->singleton('aclservice', function($app)
        {
            return new AclService(
                $app['cyrixbiz\acl\Repositories\Resource\ResourceRepository'],
                $app['Illuminate\Contracts\Auth\Guard']
            );
        });
    }

    /**
     * set the Blade Variables
     *
     * @return void
     */
    public function setBladeVariables()
    {

        Blade::if('perm', function ($item)
        {
            return hasResource($item);
        });


        Blade::if('perms', function (array $items)
        {
            return hasResource($items);
        });

        Blade::if('orPerms', function (array $items)
        {
            foreach ($items as $value)
            {
                if(hasResource($value))
                {
                    return true;
                }
            }
            return false;
        });

    }
}
?>