<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class leagueStandingsProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->sidebarStandings();
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    private function sidebarStandings(){
        view()->composer('standingsFormats.standings','App\Http\LeagueStandings\leagueStandingsAPI');
    }
}
