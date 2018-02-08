<?php

namespace Baraear\ThaiAddress;

use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\Application as LaravelApplication;
use Baraear\ThaiAddress\Contracts\District as DistrictContract;
use Baraear\ThaiAddress\Contracts\Province as ProvinceContract;
use Baraear\ThaiAddress\Contracts\PostalCode as PostalCodeContract;
use Baraear\ThaiAddress\Contracts\SubDistrict as SubDistrictContract;

class ThaiAddressServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app instanceof LaravelApplication) {
            $this->publishes([
                __DIR__.'/../config/thai_address.php' => config_path('thai_address.php'),
            ], 'config');
            if (! class_exists('CreateThaiAddressTables')) {
                $timestamp = date('Y_m_d_His', time());
                $this->publishes([
                    __DIR__.'/../database/migrations/create_thai_address_tables.php.stub' => $this->app->databasePath()."/migrations/{$timestamp}_create_thai_address_tables.php",
                ], 'migrations');
            }
            if (! class_exists('ThaiAddressTablesSeeder')) {
                $this->publishes([
                    __DIR__.'/../database/seeds/ThaiAddressTablesSeeder.php.stub' => $this->app->databasePath().'/seeds/ThaiAddressTablesSeeder.php',
                ], 'seeds');
            }
        }

        $this->loadRoutesFrom(__DIR__.'/../routes/api.php');
        $this->registerModelBindings();
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app instanceof LaravelApplication) {
            $this->mergeConfigFrom(
                __DIR__.'/../config/thai_address.php',
                'thai_address'
            );
        }
    }

    protected function registerModelBindings()
    {
        $config = $this->app->config['thai_address.models'];

        $this->app->bind(SubDistrictContract::class, $config['sub_district']);
        $this->app->bind(DistrictContract::class, $config['district']);
        $this->app->bind(ProvinceContract::class, $config['province']);
        $this->app->bind(PostalCodeContract::class, $config['postal_code']);
    }
}
