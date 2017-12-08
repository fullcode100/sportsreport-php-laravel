@extends('layouts.app')

@section('content')

	<div class="container">
		<div class="row">
			@foreach ($feed_data as $feed_item)
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<h2>{{$feed_item->highlight_title}}</h2>
					<div>
						{!!$feed_item->embed_data!!}
					</div>
					<p>{{$feed_item->highlight_description}}</p>
				</div>
			@endforeach
		</div>
	</div>

@endsection