<div class="pvm">
	<h3><i class="fas fa-baseball-ball"></i> MLB Standings:</h3>
	<h4>American League</h4>
	<h5>East</h5>
	<table class="table table-sm">
		<thead>
			<tr>
				<th scope="col">#</th>
				<th scope="col">Team:</th>
				<th scope="col">W-L</th>
				<th scope="col">GB</th>
			</tr>
		</thead>
		<tbody>
			<?php $standing_pos = 1; ?>
			@foreach($mlb_standings['mlb_al_east'] as $team)
				<tr>
					<th scope="row">{{$standing_pos}}</th>
					<td>{{$team->first_name}} {{$team->last_name}}</td>
					<td>{{$team->won}}-{{$team->lost}}</td>
					<td>{{$team->games_back}}</td>
				</tr>
				<?php $standing_pos = $standing_pos + 1; ?>
			@endforeach
		</tbody>
	</table>

	<h5>Central</h5>
	<table class="table table-sm">
		<thead>
			<tr>
				<th scope="col">#</th>
				<th scope="col">Team:</th>
				<th scope="col">W-L</th>
				<th scope="col">GB</th>
			</tr>
		</thead>
		<tbody>
			<?php $standing_pos = 1; ?>
			@foreach($mlb_standings['mlb_al_central'] as $team)
				<tr>
					<th scope="row">{{$standing_pos}}</th>
					<td>{{$team->first_name}} {{$team->last_name}}</td>
					<td>{{$team->won}}-{{$team->lost}}</td>
					<td>{{$team->games_back}}</td>
				</tr>
				<?php $standing_pos = $standing_pos + 1; ?>
			@endforeach
		</tbody>
	</table>

	<h5>West</h5>
	<table class="table table-sm">
		<thead>
			<tr>
				<th scope="col">#</th>
				<th scope="col">Team:</th>
				<th scope="col">W-L</th>
				<th scope="col">GB</th>
			</tr>
		</thead>
		<tbody>
			<?php $standing_pos = 1; ?>
			@foreach($mlb_standings['mlb_al_west'] as $team)
				<tr>
					<th scope="row">{{$standing_pos}}</th>
					<td>{{$team->first_name}} {{$team->last_name}}</td>
					<td>{{$team->won}}-{{$team->lost}}</td>
					<td>{{$team->games_back}}</td>
				</tr>
				<?php $standing_pos = $standing_pos + 1; ?>
			@endforeach
		</tbody>
	</table>

	<h4>National League</h4>
	<h5>East</h5>
	<table class="table table-sm">
		<thead>
			<tr>
				<th scope="col">#</th>
				<th scope="col">Team:</th>
				<th scope="col">W-L</th>
				<th scope="col">GB</th>
			</tr>
		</thead>
		<tbody>
			<?php $standing_pos = 1; ?>
			@foreach($mlb_standings['mlb_nl_east'] as $team)
				<tr>
					<th scope="row">{{$standing_pos}}</th>
					<td>{{$team->first_name}} {{$team->last_name}}</td>
					<td>{{$team->won}}-{{$team->lost}}</td>
					<td>{{$team->games_back}}</td>
				</tr>
				<?php $standing_pos = $standing_pos + 1; ?>
			@endforeach
		</tbody>
	</table>

	<h5>Central</h5>
	<table class="table table-sm">
		<thead>
			<tr>
				<th scope="col">#</th>
				<th scope="col">Team:</th>
				<th scope="col">W-L</th>
				<th scope="col">GB</th>
			</tr>
		</thead>
		<tbody>
			<?php $standing_pos = 1; ?>
			@foreach($mlb_standings['mlb_nl_central'] as $team)
				<tr>
					<th scope="row">{{$standing_pos}}</th>
					<td>{{$team->first_name}} {{$team->last_name}}</td>
					<td>{{$team->won}}-{{$team->lost}}</td>
					<td>{{$team->games_back}}</td>
				</tr>
				<?php $standing_pos = $standing_pos + 1; ?>
			@endforeach
		</tbody>
	</table>

	<h5>West</h5>
	<table class="table table-sm">
		<thead>
			<tr>
				<th scope="col">#</th>
				<th scope="col">Team:</th>
				<th scope="col">W-L</th>
				<th scope="col">GB</th>
			</tr>
		</thead>
		<tbody>
			<?php $standing_pos = 1; ?>
			@foreach($mlb_standings['mlb_nl_west'] as $team)
				<tr>
					<th scope="row">{{$standing_pos}}</th>
					<td>{{$team->first_name}} {{$team->last_name}}</td>
					<td>{{$team->won}}-{{$team->lost}}</td>
					<td>{{$team->games_back}}</td>
				</tr>
				<?php $standing_pos = $standing_pos + 1; ?>
			@endforeach
		</tbody>
	</table>
</div>