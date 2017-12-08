@extends('layouts.app')

@section('content')

<div class="container">
	<div class="row">
			<div class="panel-body">				
				<!-- Edit Source Form -->
				<form action="/preview-post-output" method="POST" class="form-horizontal">
					{{ csrf_field() }}

					<!-- Edit Source Info Fields -->
						<div class="col-xs-12 col-md-12">
							<p><strong>Post Source:</strong></p>

							<select name="content_source">
							  <option value="instagram">instagram</option>
							  <option value="other">other</option>
							</select>
  						</div>
					
  						<div class="clear"></div>

						<div class="col-xs-12 col-md-10">
							<p><strong>Content URL:</strong> <input type="text" name="content_url" id="content_url" class="formWidth"></p>
						</div>
						
					
					<!-- Update Source Button -->
					<div class="form-group">
						<div class="col-sm-6">
							<button type="submit" class="btn btn-default">
								<i class="fa fa-plus"></i> Preview Embeded Content
							</button>
						</div>
					</div>
				</form>
				<!-- End Edit Source Form -->
			</div>
		</div>
		</div>
@endsection