@extends('layouts.app')

@section('content')

	<div class="container">
		<div class="row">
			@foreach ($feed_data as $feed_item)
				<div id="{{$feed_item->highlight_id}}" class="col-xs-12 col-sm-12 col-md-12 col-lg-12 single-post">
					<h2>{{$feed_item->highlight_title}}</h2>
					<div>
						{!!$feed_item->embed_data!!}
					</div>
					<p>{{$feed_item->highlight_description}}</p>
					<p>
						<span class="share-btn">
						<span class="btn-link pointer-cursor" data-toggle="popover" data-html="true" data-placement="auto top" title="Share: <b>{{$feed_item->highlight_title}}</b>" data-content="<p>From: {{$feed_item->origin_url}}</p> <p>Here: {{ url('/') }}{{$feed_item->highlight_id}}</p>">Share</span>
						|</span>
						<a href="/highlight/{{$feed_item->highlight_id}}">Comment</a> 
					<hr>
				</div>
			@endforeach
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