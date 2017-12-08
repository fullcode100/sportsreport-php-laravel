@extends('layouts.app')

@section('content')

	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

				<h1>Preview this post:</h1>
				<h5 class="text-muted">Basically make sure embeding works properly.</h5>

				<h2>Post from: {{$post_preview_data['source_site']}}</h2>
				<h4>Origin URL: {{$post_preview_data['source_url']}}</h4>

				<div>
					{!! $post_preview_data['raw_embed_html'] !!}
				</div>
			</div>
		</div>
	</div>

@endsection