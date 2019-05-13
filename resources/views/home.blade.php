@extends('layouts.app')

@section('title', 'Site Administration')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-xs-12 col-md-12">
            <h2>User Dashboard</h2>

            @include('common.errors')

            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            <ul>
                <li><a href="/preview-post">Add New Highlight</a></li>
                <li><a href="/">View All Highlights</a></li>
                <li><a href="/new-top-of-the-week">Create new <em>Top Of The Week</em> entry</a></li>
                <li><a href="/all-top-of-the-weeks">Browse all <em>Top Of The Week</em> entries</a></li>
            </ul>
        </div>

        <div class="col-xs-12 col-md-12">
            @if(Auth::user()->api_token == null)
                Current API Token: <strong>[NOT SET]</strong>
            @else
                Current API Token: <strong>{{Auth::user()->api_token}}</strong>
            @endif

            <a href="/new_api_key" class="text-success">[GENERATE NEW API KEY]</a>
        </div>
    </div>
</div>
@endsection
