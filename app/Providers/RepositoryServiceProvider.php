<?php

namespace App\Providers;


use App\Contracts\CompanyContract;
use App\Repositories\CompanyRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    protected $repositories = [
        CompanyContract::class => CompanyRepository::class,
    ];

    public function register(){

    }

    public function boot(){
        foreach($this->repositories as $interface => $implementation){
            $this->app->bind($interface, $implementation);
        }
    }
}
