<?php
namespace cyrixbiz\acl;
use cyrixbiz\acl\Helper\AclHelper;
use Illuminate\Support\ServiceProvider;

class AclServiceProvider extends ServiceProvider {

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
        $this->loadViewsFrom(__DIR__.'/resources/views', 'Acl');
        /*
         * Load the Migrations from the Package
         */
        $this->loadMigrationsFrom(__DIR__.'/Database/migrations');

        $this->publishes([
            __DIR__ . '/config/acl.php' => config_path('acl.php'),
        ]);
    }

    public function register()
    {
        // Load Config File
        $this->mergeConfigFrom(

            __DIR__ . '/config/acl.php' , 'acl'
        );

        $this->app->singleton('aclhelper', function($app)
        {
            return new AclHelper(
                $app['cyrixbiz\acl\Models\Resource'],
                //$app['App\Database\Repositories\ResourceRepository'],
                $app['Illuminate\Contracts\Auth\Guard']
            );
        });
    }
}
?>