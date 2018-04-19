@extends('layouts.app')

@section('title', 'Site Administration')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
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
            </div>
        </div>
    </div>
</div>
@endsection
