@extends('layout.master')

@section('content')
    <div class="hero">
        <h3>Find your top nine posts on Instagram in 2017!</h3>
        <input type="text" class="form-control username-search" placeholder="Instagram Username">
        <a href="https://api.instagram.com/oauth/authorize/?client_id={{ env('CLIENT-ID') }}&redirect_uri={{ env('REDIRECT-URI') }}&response_type=code&scope=public_content" class="search-button"><i class="fa fa-search"></i></a>
    </div>
    <div class="top-insta">
    	<h3>Top Instagrammers of 2017</h3>
    	<h5>From Instagram's year in review, we've listed the most followed Instagrammer's of 2017</h5>
		@php
			for($count=1;$count<=10;$count++){
				echo "<div><img src=\"images\\celebrities\\{$count}.png\"/></div>";
			}
		@endphp
    </div>
@endsection