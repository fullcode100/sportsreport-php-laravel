@extends('layouts.app')

@section('title', 'Preview New Post')

@section('content')

<div class="container">

		@include('common.errors')

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

		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
				<h1>Everything look good?</h1>
				<h5 class="text-success">Add the post to the feed!</h5>

				<div class="panel-body">
				<!-- Preview a post of embeded content -->
				<form action="/add-new-highlight" autocomplete="off" method="POST" class="form-horizontal">
					{{ csrf_field() }}

					<input type="hidden" name="content_origin_url" value="{{$post_preview_data['source_url']}}">
					<input type="hidden" name="content_origin_source" value="{{$post_preview_data['source_site']}}">
					<input type="hidden" name="content_embed_html" value="{!! $post_preview_data['source_url'] !!}">

					<!-- Edit Source Info Fields -->					
  						<div class="clear"></div>

						<div class="col-xs-12 col-md-10">
							<p><strong>Highlight Title:</strong> <input type="text" name="highlight_title" id="highlight_title" class="formWidth"> <strong class="text-danger">required</strong></p>
						</div>

						<div class="col-xs-12 col-md-10">
							<p><strong>Highlight Description:</strong> <input type="text" name="highlight_description" id="highlight_description" class="formWidth"> <em class="text-info">optional</em></p>
						</div>
						
					<!-- Update Source Button -->
					<div class="form-group">
						<div class="col-sm-6">
							<button type="submit" class="btn btn-default"><i class="fa fa-plus"></i> Add Highlight Reel</button>
						</div>
					</div>
				</form>
				<!-- End Preview a post of embeded content -->
			</div>
		</div>

		<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
			<!--If you messed something up in the submission go back and start over.-->
				<h1 class="text-danger">No, wait!</h1>
				<h5 class="text-warning">I screwed something up.</h5>
				<a href="/preview-post"><button type="button" class="btn btn-warning">Go back and try this again.</button></a>
		</div>
	</div>
</div>

@endsection