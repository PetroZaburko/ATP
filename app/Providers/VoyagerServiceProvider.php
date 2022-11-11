<?php

namespace App\Providers;

use App\Actions\VoyagerActions\ConvertCandidateAction;
use Illuminate\Support\ServiceProvider;
use TCG\Voyager\Facades\Voyager;

class VoyagerServiceProvider extends ServiceProvider
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
        Voyager::addAction(ConvertCandidateAction::class);
    }
}
