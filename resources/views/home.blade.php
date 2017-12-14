@extends('layout.master')

@section('content')
    <div class="hero" style="border-bottom: 2px solid #666;">
        <h3>Find your top nine posts on Instagram in 2017!</h3>
        <input type="text" class="form-control username-search" placeholder="Instagram Username">
        <a href="https://api.instagram.com/oauth/authorize/?client_id={{ env('CLIENT-ID') }}&redirect_uri={{ env('REDIRECT-URI') }}&response_type=code&scope=public_content" class="search-button"><i class="fa fa-search"></i></a>
        <br>
        <br>
        <br>
        <h4>Approved​ ​and​ fully​​ in​​ line​​ with​​ Instagram's​ ​terms​ ​of​ service,​​ the​ safe​​ way​ ​to​​ get​​ your​​ top
        nine​​ posts​​ of​ the​​ year.</h4>
    </div>
    <div class="top-insta">
    	<h1>Top Instagrammers of 2017</h1>
    	<h3>From Instagram's year in review, we've listed the most followed Instagrammer's of 2017</h3>
        <br>
        <br>
        <br>
		@php
			for($count=1;$count<=10;$count++){
				echo "<div class=\"col-sm-12 col-xs-12 col-md-4 col-md-offset-4 col-lg-4 col-lg-offset-4\"><img src=\"images\\celebrities\\{$count}.png\"/></div>";
			}
		@endphp
    </div>
@endsection