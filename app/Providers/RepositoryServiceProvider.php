<?php

namespace App\Providers;

use App\Repositories\Contracts\{
    CategoryRepositoryInterface,
    ProductRepositoryInterface
};

use App\Repositories\Core\Eloquent\{EloquentCategoryRepository, EloquentProductRepository};

use App\Repositories\Core\QueryBuilder\{
    QueryBuilderCategoryRepository
};
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
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(
            ProductRepositoryInterface::class,
            EloquentProductRepository::class
        );

        $this->app->bind(
            CategoryRepositoryInterface::class,
            //QueryBuilderCategoryRepository::class
            EloquentCategoryRepository::class
        );
    }
}
