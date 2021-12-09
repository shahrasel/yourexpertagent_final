<?php

namespace App\Providers;

use App\Models\ResProperties;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $cityLists = ResProperties::select(DB::raw('CITY, count(id) as total'))
            ->where('LISTSTATUS','Active')
            ->orderBy('total', 'desc')
            ->groupBy('CITY')
            ->get();
        //dd($cityLists);
        view()->share('cityLists', $cityLists);
    }
}
