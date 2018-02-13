<?php

namespace App\Http\LeagueStandings;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Cache;

//Just import everything date and time related from php becuse laravel gets upset if you don't.
use DateTime;
use DatePeriod;
use DateIntercal;

class leagueStandingsAPI{

	private $nhl_standings_url = 'https://statsapi.web.nhl.com/api/v1/standings?season=20172018';
	private $nba_standings_url = 'https://erikberg.com/nba/standings.json';

	public function compose($view){
		$view->with(['standings'=> $this->nhl_standings(),'nba_standings' => $this->nba_standings()]);
	}

	private function nhl_standings(){

		$expire_nhl = now()->addMinutes(30);

		$nhl_standings_data = Cache::remember('nhl_standings_json',$expire_nhl,function(){
			$get_data = file_get_contents($this->nhl_standings_url);
			$parsed_data = json_decode($get_data);
			return $parsed_data;
		});

		return $nhl_standings_data;
	}

	private function nba_standings(){
		$expire_nba = now()->addMinutes(60);

		$nba_standings_data = Cache::remember('nba_standings_json',$expire_nba,function(){
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $this->nba_standings_url);
			curl_setopt($ch,CURLOPT_USERAGENT,"Highlights Arena Standings Crawler/0.2 (jackemceachern@gmail.com)");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			$result = curl_exec($ch);
			curl_close($ch);

			$parsed_data = json_decode($result);

			//Split the NBA standings into East Vs West since they are all presented in one list.
			$nba_east = collect();
			$nba_west = collect();

			foreach($parsed_data->standing as $team){
				if($team->conference === "EAST"){
					$nba_east->push($team);
				}else if($team->conference === "WEST"){
					$nba_west->push($team);
				}
			}

			return ['nba_east'=>$nba_east,'nba_west'=>$nba_west];
		});

		return $nba_standings_data;
		
	}

}

?>