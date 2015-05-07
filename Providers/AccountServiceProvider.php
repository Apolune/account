<?php namespace Apolune\Account\Providers;

use Apolune\Core\Providers\PackageServiceProvider;

class AccountServiceProvider extends PackageServiceProvider {

	/**
	 * Bootstrap any application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->loadViewsFrom(__DIR__.'/../../resources/views', 'pandaac/account');

		$this->loadTranslationsFrom(__DIR__.'/../../resources/lang', 'pandaac/account');
	}

	/**
	 * Register any application services.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->bindContracts();

		$this->app->register('Apolune\Account\Providers\HashServiceProvider');

		$this->app->register('Apolune\Account\Providers\AuthServiceProvider');
		
		$this->app->register('Apolune\Account\Providers\RouteServiceProvider');
	}

	/**
	 * Bind the required contracts.
	 *
	 * @return void
	 */
	private function bindContracts()
	{
		$this->app->bind('Illuminate\Contracts\Auth\Registrar', 'Apolune\Account\Services\Registrar');

		$this->app->bind('Apolune\Contracts\Account\Account', 'Apolune\Account\Models\Account');
	}

}
