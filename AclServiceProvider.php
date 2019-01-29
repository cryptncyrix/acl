<?php
namespace cyrixbiz\acl;
use Illuminate\Support\ServiceProvider;

class AclServiceProvider extends ServiceProvider {

    public function boot()
    {
        /*
         * Load the Routes from the Package
         */
        $this->loadRoutesFrom(__DIR__.'/routes/web.php');
        /*
         * Load the Views from the Package
         */
        $this->loadViewsFrom(__DIR__.'/resources/views', 'Acl');
    }
    public function register()
    {
    }
}
?>