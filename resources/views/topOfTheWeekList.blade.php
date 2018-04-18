@extends('layouts.app')

<?php $page_title = "Top highlights of the week." ?>

@section('content')
	<div class="container">
		<div class="row">			
			<div class="col-xs-12 col-sm-12 col-md-8 col-lg-9">
				<h1 class="mvl"><i class="fas fa-film"></i>&nbsp;Highlights By Week</h1>
				<p>Eac week Highlights Arena collects some of the best highlights from around the NFL, MLB, NBA, NHL, NCAA, and really anywhere else sports are played.</p>
				<p>Each weeks collection of highlights are forever archived into the Top Of The Week listings. A great place to look back on what you missed this week, or just a way to
				get relive some of your favorite moments.</p>

				@if(count($week_list) === 0)
					<h2>This page is a mirage.</h2>
					<p>Come back later and maybe something will appear.</p>
				@else
					@foreach($week_list as $week)
						<h2>
							<a href="/top-of-the-week/{{$week->month}}/{{$week->day}}/{{$week->year}}" title="View all highlights for the week of {{$week->month}}/{{$week->day}}/{{$week->year}}">
								Highlights for the week of {{$week->month}}/{{$week->day}}/{{$week->year}}
							</a>
						</h2>
						@if($week->description != null)
							<p>{{$week->description}}</p>
						@endif
					@endforeach
				@endif
			</div>
			

			<div class="col-xs-12 col-sm-12 col-md-4 col-lg-3 mtl">
				@include('standingsFormats.standings')
			</div>
		</div>
	</div>
@endsection