<?php

namespace App\Providers;

use App\Repositories\AdditionalContactRepository\AdditionalContactRepository;
use App\Repositories\AdditionalContactRepository\AdditionalContactRepositoryInterface;
use App\Repositories\ContactRepository\ContactRepository;
use App\Repositories\ContactRepository\ContactRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {

        $this->app->bind(ContactRepositoryInterface::class, ContactRepository::class);
        $this->app->bind(AdditionalContactRepositoryInterface::class, AdditionalContactRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
