<div class="pvm">
	<h3><i class="fas fa-baseball-ball"></i> MLB Standings:</h3>
	<h4>American League</h4>
	<h5>East</h5>
	<table class="table table-sm">
		<thead>
			<tr>
				<th scope="col">Team:</th>
				<th scope="col">W-L</th>
				<th scope="col">GB</th>
			</tr>
		</thead>
		<tbody>
			@foreach($mlb_standings['mlb_al_east'] as $team)
				<tr>
					<td>{{$team->first_name}} {{$team->last_name}}</td>
					<td>{{$team->won}}-{{$team->lost}}</td>
					<td>{{$team->games_back}}</td>
				</tr>
			@endforeach
		</tbody>
	</table>

	<h5>Central</h5>
	<table class="table table-sm">
		<thead>
			<tr>
				<th scope="col">Team:</th>
				<th scope="col">W-L</th>
				<th scope="col">GB</th>
			</tr>
		</thead>
		<tbody>
			@foreach($mlb_standings['mlb_al_central'] as $team)
				<tr>
					<td>{{$team->first_name}} {{$team->last_name}}</td>
					<td>{{$team->won}}-{{$team->lost}}</td>
					<td>{{$team->games_back}}</td>
				</tr>
			@endforeach
		</tbody>
	</table>

	<h5>West</h5>
	<table class="table table-sm">
		<thead>
			<tr>
				<th scope="col">Team:</th>
				<th scope="col">W-L</th>
				<th scope="col">GB</th>
			</tr>
		</thead>
		<tbody>
			@foreach($mlb_standings['mlb_al_west'] as $team)
				<tr>
					<td>{{$team->first_name}} {{$team->last_name}}</td>
					<td>{{$team->won}}-{{$team->lost}}</td>
					<td>{{$team->games_back}}</td>
				</tr>
			@endforeach
		</tbody>
	</table>

	<h4>National League</h4>
	<h5>East</h5>
	<table class="table table-sm">
		<thead>
			<tr>
				<th scope="col">Team:</th>
				<th scope="col">W-L</th>
				<th scope="col">GB</th>
			</tr>
		</thead>
		<tbody>
			@foreach($mlb_standings['mlb_nl_east'] as $team)
				<tr>
					<td>{{$team->first_name}} {{$team->last_name}}</td>
					<td>{{$team->won}}-{{$team->lost}}</td>
					<td>{{$team->games_back}}</td>
				</tr>
			@endforeach
		</tbody>
	</table>

	<h5>Central</h5>
	<table class="table table-sm">
		<thead>
			<tr>
				<th scope="col">Team:</th>
				<th scope="col">W-L</th>
				<th scope="col">GB</th>
			</tr>
		</thead>
		<tbody>
			@foreach($mlb_standings['mlb_nl_central'] as $team)
				<tr>
					<td>{{$team->first_name}} {{$team->last_name}}</td>
					<td>{{$team->won}}-{{$team->lost}}</td>
					<td>{{$team->games_back}}</td>
				</tr>
			@endforeach
		</tbody>
	</table>

	<h5>West</h5>
	<table class="table table-sm">
		<thead>
			<tr>
				<th scope="col">Team:</th>
				<th scope="col">W-L</th>
				<th scope="col">GB</th>
			</tr>
		</thead>
		<tbody>
			@foreach($mlb_standings['mlb_nl_west'] as $team)
				<tr>
					<td>{{$team->first_name}} {{$team->last_name}}</td>
					<td>{{$team->won}}-{{$team->lost}}</td>
					<td>{{$team->games_back}}</td>
				</tr>
			@endforeach
		</tbody>
	</table>
</div>