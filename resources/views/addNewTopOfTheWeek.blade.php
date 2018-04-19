@extends('layouts.app')

@section('content')

<div class="container">
	<div class="row">

		@include('common.errors')

		<div class="panel-body">				
			<!-- Preview a post of embeded content -->
			<form action="/add-new-top-of-the-week" autocomplete="off" method="POST" class="form-horizontal">
				{{ csrf_field() }}

				<!-- Edit Source Info Fields -->
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<p><strong>Month: <span class="text-danger">*</span></strong>

						<select name="month">
						  <option value="1">January</option>
						  <option value="2">February</option>
						  <option value="3">March</option>
						  <option value="4">April</option>
						  <option value="5">May</option>
						  <option value="6">June</option>
						  <option value="7">July</option>
						  <option value="8">August</option>
						  <option value="9">September</option>
						  <option value="10">October</option>
						  <option value="11">November</option>
						  <option value="12">December</option>
						</select>
						</p>
						</div>

						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<p><strong>Day: <span class="text-danger">*</span></strong>

						<select name="day">
						  <option value="1">1st</option>
						  <option value="2">2nd</option>
						  <option value="3">3rd</option>
						  <option value="4">4th</option>
						  <option value="5">5th</option>
						  <option value="6">6th</option>
						  <option value="7">7th</option>
						  <option value="8">8th</option>
						  <option value="9">9th</option>
						  <option value="10">10th</option>
						  <option value="11">11th</option>
						  <option value="12">12th</option>
						  <option value="13">13th</option>
						  <option value="14">14th</option>
						  <option value="15">15th</option>
						  <option value="16">16th</option>
						  <option value="17">17th</option>
						  <option value="18">18th</option>
						  <option value="19">19th</option>
						  <option value="20">20th</option>
						  <option value="21">21st</option>
						  <option value="22">22nd</option>
						  <option value="23">23rd</option>
						  <option value="24">24th</option>
						  <option value="25">25th</option>
						  <option value="26">26th</option>
						  <option value="27">27th</option>
						  <option value="28">28th</option>
						  <option value="29">29th</option>
						  <option value="30">30hth</option>
						  <option value="21">31st</option>
						</select>
						</p>
						</div>

						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<p><strong>Year: <span class="text-danger">*</span></strong>

						<select name="year">
							<option value="2017">2017</option>	
						  	<option value="2018">2018</option>
						 	<option value="2019">2019</option>
						</select>
						</p>
						</div>
				
						<div class="clear"></div>

					<div class="col-xs-12 col-md-10">
						<p><strong>Vanity URL:</strong> <input type="text" name="vanity_url" id="vanity_url" class="formWidth" maxlength="99"></p>
					</div>

					<div class="col-xs-12 col-md-10">
						<p><strong>Description: <span class="text-primary">^</span></strong>
							<textarea rows="4" cols="50" name="description" id="description" class="formWidth"></textarea>
						</p>
					</div>
					
				
				<!-- Update Source Button -->
				<div class="form-group">
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
						<button type="submit" class="btn btn-default cursor-pointer">
							<i class="fa fa-plus"></i> Create Top Of The Week URL
						</button>
					</div>
				</div>
			</form>

			<p><span class="text-danger">* - Required field.</span></p>
			<p><span class="text-primary">^ - Highly recommended field.</span></p>
		</div>
	</div>
</div>
@endsection