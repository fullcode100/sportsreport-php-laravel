<div class="pvm">
<h2>NHL Standings:</h2>
@foreach($standings->records as $division)
	<h4>{{$division->division->name}} Division</h4>
	<ol class="mlm plm">
	@foreach($division->teamRecords as $team)
		<li>
			<p>{{$team->team->name}} | Pts: {{$team->points}}</p>
			<p>Record: {{$team->leagueRecord->wins}}-{{$team->leagueRecord->losses}}-{{$team->leagueRecord->ot}}</p>
		</li>
	@endforeach
	</ol>
@endforeach
</div>

<div class="pvm">
	<h1>NBA Standings:</h1>
	<ol class="mlm plm">
	@foreach($nba_standings->standing as $team)
		<li>{{$team->first_name}} {{$team->last_name}}</li>
	@endforeach
	</ol>
</div>