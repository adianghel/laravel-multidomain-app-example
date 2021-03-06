<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        // Pattern for matching any domain (used for sites)
        $this->app['router']->pattern('domain', '.+');

        // Pattern for matching domain of master admin panel
        $this->app['router']->pattern(
            'masterAdminDomain',
            env('MASTER_ADMIN_DOMAIN', 'master.foobar.com')
        );

        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapMasterAdminRoutes();
        $this->mapAdminRoutes();
        $this->mapSiteRoutes();
    }

    /**
     * Routes for the site.
     *
     * @return void
     */
    protected function mapSiteRoutes()
    {
        Route::middleware('web')
             ->namespace($this->namespace)
             ->group(base_path('routes/web/Site.php'));
    }

    /**
     * Routes for the site admin panel.
     *
     * @return void
     */
    protected function mapAdminRoutes()
    {
        Route::middleware('web')
             ->namespace($this->namespace)
             ->group(base_path('routes/web/Admin.php'));
    }

    /**
     * Routes for the master admin panel.
     *
     * @return void
     */
    protected function mapMasterAdminRoutes()
    {
        Route::middleware('web')
             ->namespace($this->namespace)
             ->group(base_path('routes/web/MasterAdmin.php'));
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api')
             ->middleware('api')
             ->namespace($this->namespace)
             ->group(base_path('routes/api.php'));
    }
}
