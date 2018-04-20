@extends('layouts.app')

@section('content')

	<?php 
	//These variables will filter back to the app.blade layout and be interpereted as meta data for the page.
	$page_title = "Top Hightlights for the week of " . $date_range;
	$page_meta_description = "Every week " . config('app.name', 'Sports Highlights and Photography') . " collects dozens of the top highlights from around the world of sports and catalogs them for easy access later on. If you missed them catch up, of if you saw them already relive the best sports highlights for the week of " . $date_range . ".";
	?>

	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<h1 class="pll mvl"><i class="fas fa-film"></i>&nbsp;Top Hightlights for the week of {{$date_range}}:</h1>
			</div>
		</div>

		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-8 col-lg-9">
				@foreach ($feed_data as $feed_item)
					<div id="{{$feed_item->highlight_id}}" class="col-xs-12 col-sm-12 col-md-12 col-lg-12 single-post mvm">
						<h2><a href="/highlight/{{$feed_item->highlight_id}}/{{$feed_item->url_slug}}" class="title-link">{{$feed_item->highlight_title}}</a></h2>
						<div>
							{!!$feed_item->embed_data!!}
						</div>
						<p>{!!$feed_item->highlight_description!!}</p>
						<p>
							<span class="share-btn">
								<span tabindex="0" class="btn-link pointer-cursor" role="button" data-toggle="popover" data-html="true" title="Share: <b>{{$feed_item->highlight_title}}</b>" data-content="<p>From: {{$feed_item->origin_url}}</p> <p>Here: {{ url('/') }}/{{$feed_item->highlight_id}}</p>">Share</span>
								|
							</span>
							<a href="/highlight/{{$feed_item->highlight_id}}/{{$feed_item->url_slug}}/#comments">Comment</a> 
						</p>
					</div>
				@endforeach
			</div>

			<div class="col-xs-12 col-sm-12 col-md-4 col-lg-3">
				@include('standingsFormats.standings')
			</div>
		</div>
	</div>

	<script>
	window.onload = function () {
	$('[data-toggle="popover"]').popover({
		container: '.single-post'
	});
    jQuery('.share-btn').css('opacity', '1');
};
</script>
@endsection