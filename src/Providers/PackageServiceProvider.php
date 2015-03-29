<?php namespace Apolune\pandaac\Account\Providers;

use Apolune\pandaac\Core\Providers\ServiceProvider;

class PackageServiceProvider extends ServiceProvider {

	/**
	 * Bootstrap any application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->loadViewsFrom(__DIR__.'/../../resources/views', 'pandaac/account');

		$this->loadTranslationsFrom(__DIR__.'/../../resources/lang', 'pandaac/account');

		$this->publishes([
			__DIR__.'/../../config/package.php' => config_path('pandaac/account.php'),
		]);
	}

	/**
	 * Register any application services.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app->register('pandaac\Account\Providers\RouteServiceProvider');

		$this->app->bind(
			'Illuminate\Contracts\Auth\Registrar',
			'pandaac\Account\Services\Registrar'
		);
	}

}
