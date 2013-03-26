<?php namespace Teepluss\Debug;

use Illuminate\Support\ServiceProvider;

class DebugServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->package('teepluss/debug');

        // Bring the application container instance into the local scope so we can
        // import it into the filters scope.
        //$app = $this->app;
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app['debug'] = $this->app->share(function($app)
        {
        	return new Debug;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array('debug');
    }

}