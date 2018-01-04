@extends('layouts.app')

@section('content')

	<div class="container">
		<div class="row">

			@include('common.errors')

			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<h2>{{$highlight_data->highlight_title}}</h2>
				<div>
					{!! $highlight_data->embed_data !!}
				</div>
				<p>{!! $highlight_data->highlight_description !!}</p>
				<p class="text-muted">Found on <span class="text-capitalize">{{$highlight_data->service_origin}}</span> (<a href="{{$highlight_data->origin_url}}" target="_blank">{{$highlight_data->origin_url}}</a>) | Posted: @if($highlight_data->created_at == null)
									Unknown
								@else
									{{$highlight_data->created_at}}
								@endif</p>
				<hr>
			</div>

			@if(count($highlight_data->post_tags) != 0)
			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
				<p>Tagged:
					@foreach($highlight_data->post_tags as $post_tag)
						<a href="/tagged/{{$post_tag['tag_url']}}" class="badge badge-info">{{$post_tag['tag_read']}}</a>
					@endforeach
				</p>
			</div>
			@endif
		</div>

			@if(Auth::User())
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
					<form action="/new-tag-set" method="POST" class="form-horizontal">
						{{ csrf_field() }}
						<input type="hidden" name="highlight_id" value="{{$highlight_data->highlight_id}}">
						Tags: <input type="text" name="tags" maxlength="100">
						<button type="submit" class="btn btn-success">Add Tags</button>
						<p class="text-warning">Maximum 100 characters. Tags are seperated with commas.</p>
					</form>
				</div>

				<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
					<form action="/delete-highlight" method="POST" class="form-horizontal" onsubmit="return confirm('Are you sure you want to delete this?');">
						{{ csrf_field() }}
						<input type="hidden" name="highlight_unique_id" value="{{$highlight_data->highlight_id}}">
						<button type="submit" class="btn btn-danger">Delete This Highlight</button>
						<p class="text-warning">There is no going back from this!</p>
					</form>
				</div>
			</div>
			@endif
		

		<div class="row" id="comments">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<div id="disqus_thread"></div>
				<script>
				var disqus_config = function () {
				this.page.url = "{{ url('/') }}/{{$highlight_data->highlight_id}}/{{$highlight_data->url_slug}}";
				this.page.identifier = {{$highlight_data->highlight_id}};
				};
				(function() {
				var d = document, s = d.createElement('script');
				s.src = 'https://highlightsarena-1.disqus.com/embed.js';
				s.setAttribute('data-timestamp', +new Date());
				(d.head || d.body).appendChild(s);
				})();
				</script>
				<noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
			</div>
		</div>
	</div>
@endsection

@section('title')
	{{$highlight_data->highlight_title}}
@endsection

@section('meta_descriptor')
{{$highlight_data->highlight_title}}. {{$highlight_data->highlight_description}}
@endsection