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
	private $mlb_standings_url = 'https://erikberg.com/mlb/standings.json';

	public function compose($view){
		$view->with(['nhl_standings'=> $this->nhl_standings(),'nba_standings' => $this->nba_standings(),'mlb_standings' => $this->mlb_standings()]);
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
			curl_setopt($ch,CURLOPT_USERAGENT,env('APP_USERAGENT', null));
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			$result = curl_exec($ch);
			curl_close($ch);

			$parsed_data = json_decode($result);

			//Split the NBA standings into East Vs West since they are all presented in one list.
			$nba_east = collect();
			$nba_west = collect();

			if(!isset($parsed_data->standing)){
				return ['nba_east'=>null,'nba_west'=>null];
			}

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

	private function mlb_standings(){
		$expire_mlb = now()->addMinutes(60);

		$mlb_standings_data = Cache::remember('mlb_standings_json',$expire_mlb,function(){
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $this->mlb_standings_url);
			curl_setopt($ch,CURLOPT_USERAGENT,env('APP_USERAGENT', null));
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			$result = curl_exec($ch);
			curl_close($ch);

			$parsed_data = json_decode($result);

			//Split the NBA standings into East Vs West since they are all presented in one list.
			$mlb_al_east = collect();
			$mlb_al_central = collect();
			$mlb_al_west = collect();

			$mlb_nl_east = collect();
			$mlb_nl_central = collect();
			$mlb_nl_west = collect();

			foreach($parsed_data->standing as $team){
				if($team->conference === "AL"){
					if($team->division === "E"){
						$mlb_al_east->push($team);
					}else if($team->division === "C"){
						$mlb_al_central->push($team);
					}else if($team->division === "W"){
						$mlb_al_west->push($team);
					}
				}else if($team->conference === "NL"){
					if($team->division === "E"){
						$mlb_nl_east->push($team);
					}else if($team->division === "C"){
						$mlb_nl_central->push($team);
					}else if($team->division === "W"){
						$mlb_nl_west->push($team);
					}
				}
			}

			return ['mlb_al_east' => $mlb_al_east,'mlb_al_central' => $mlb_al_central, 'mlb_al_west' => $mlb_al_west,'mlb_nl_east' => $mlb_nl_east,'mlb_nl_central' => $mlb_nl_central,'mlb_nl_west' => $mlb_nl_west];
		});

		return $mlb_standings_data;
	}

}

?>