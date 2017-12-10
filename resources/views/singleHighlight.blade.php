@extends('layouts.app')

@section('content')

	<div class="container">
		<div class="row">

			@include('common.errors')

			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<h2>{{$highlight_data->highlight_title}}</h2>
				<div>
					{!!$highlight_data->embed_data!!}
				</div>
				<p>{{$highlight_data->highlight_description}}</p>
				<p class="text-muted">Found on <span class="text-capitalize">{{$highlight_data->service_origin}}</span> (<a href="{{$highlight_data->origin_url}}" target="_blank">{{$highlight_data->origin_url}}</a>) | Posted: @if($highlight_data->created_at == null)
												Unknown
											@else
												{{$highlight_data->created_at}}
											@endif</p>
				<hr>
			</div>

			@if(Auth::User())
				<form action="/delete-highlight" method="POST" class="form-horizontal" onsubmit="return confirm('Are you sure you want to delete this?');">
					{{ csrf_field() }}
					<input type="hidden" name="highlight_unique_id" value="{{$highlight_data->highlight_id}}">
					<button type="submit" class="btn btn-danger">Delete This Highlight</button>
					<p class="text-warning">There is no going back from this!</p>
				</form>
			@endif
		</div>
	</div>

@endsection