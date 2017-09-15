<?php 

namespace Monarch\Providers;

/* Laravel */
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;

/* Monarch */

class MonarchServiceProvider extends ServiceProvider 
{

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
    $this->publishConfig();
  }

  /**
  * Register the service provider.
  *
  * @return void
  */
  public function register()
  {
    $this->registerCommands();  
  }

  /**
  * Publish the configuration.
  *
  * @return void
  */
  public function publishConfig()
  {  
    $config = __DIR__.'/../../config/monarch.php';
    $this->publishes([
      $config => config_path('monarch.php'),
    ], 'monarch-config'); 
  }

  /**
   * Register commands
   * @return void
   */
  public function registerCommands()
  {
    if ($this->app->runningInConsole()) 
    {
      $this->commands([
        \Monarch\Console\Commands\ExampleCommand::class,
        \Monarch\Console\Commands\MigrateCommand::class,
      ]);
    }
  }

}
