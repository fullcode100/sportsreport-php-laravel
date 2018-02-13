<div class="pvm">
<h3><i class="fas fa-hockey-puck"></i> NHL Standings:</h3>
@foreach($standings->records as $division)
	<h5>{{$division->division->name}} Division</h5>
	<table class="table table-sm">
		<thead>
			<tr>
				<th scope="col">Team</th>
				<th scope="col">W/L/OTL</th>
				<th scope="col">Pts</th>
			</tr>
		</thead>
		<tbody>
	@foreach($division->teamRecords as $team)
			<tr>
				<th scope="row">{{$team->team->name}}</th>
				<td>{{$team->leagueRecord->wins}}/{{$team->leagueRecord->losses}}/{{$team->leagueRecord->ot}}</td>
				<td>{{$team->points}}</td>
			</tr>
	@endforeach
		</tbody>
	</table>
@endforeach
</div>

<div class="pvm">
	<h3><i class="fas fa-basketball-ball"></i> NBA Standings:</h3>
	<h5>Eastern Conference Standings</h5>
	<table class="table table-sm">
		<thead>
			<tr>
				<th scope="col">#</th>
				<th scope="col">Team:</th>
				<th scope="col">W/L</th>
			</tr>
		</thead>
		<tbody>
			<?php $standing_pos = 1; ?>
			@foreach($nba_standings['nba_east'] as $team)
				<tr>
					<th scope="row">{{$standing_pos}}</th>
					<td>{{$team->first_name}} {{$team->last_name}}</td>
					<td>{{$team->won}}/{{$team->lost}}</td>
				</tr>
				<?php $standing_pos = $standing_pos + 1; ?>
			@endforeach
		</tbody>
	</table>

	<h5>Western Conference Standings</h5>
	<table class="table table-sm">
		<thead>
			<tr>
				<th scope="col">#</th>
				<th scope="col">Team</th>
				<th scope="col">W/L</th>
			</tr>
		</thead>
		<tbody>
			<?php $standing_pos = 1; ?>
			@foreach($nba_standings['nba_west'] as $team)
				<tr>
					<th scope="row">{{$standing_pos}}</th>
					<td>{{$team->first_name}} {{$team->last_name}}</td>
					<td>{{$team->won}}/{{$team->lost}}</td>
				</tr>
				<?php $standing_pos = $standing_pos + 1; ?>
			@endforeach
		</tbody>
	</table>
</div>