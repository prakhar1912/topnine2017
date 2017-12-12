@extends('layout.master')

@section('content')
	<script>window.twttr = (function(d, s, id) {
		  var js, fjs = d.getElementsByTagName(s)[0],
		    t = window.twttr || {};
		  if (d.getElementById(id)) return t;
		  js = d.createElement(s);
		  js.id = id;
		  js.src = "https://platform.twitter.com/widgets.js";
		  fjs.parentNode.insertBefore(js, fjs);

		  t._e = [];
		  t.ready = function(f) {
		    t._e.push(f);
		  };

		  return t;
		}(document, "script", "twitter-wjs"));</script>
	<div class="hero">
		<div class="welcome-message clearfix" style="position: relative;">
			<img src="{{ $user_info['profile_picture'] }}" />
			<span>Hello {{ $user_info['username'] }},</span>
			<button class="btn btn-primary button" id="logout" style="position:absolute;right:0;"><i class="fa fa-sign-out"></i>Log out</button>
		</div>
		<div id="app" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<image-display v-show="imageDisplay"></image-display>
			<message-display v-show="messageDisplay"></message-display>
		</div>
		<hr>
	</div>
	<script>
		window.username = "{{ $user_info['username'] }}";
		window.profilePicture = "{{ $user_info['profile_picture'] }}";
		window.posts = "{{ $user_info['total_posts'] }}";
		window.likes = "{{ $user_info['total_likes'] }}";
		window.topNine = {!! $user_info['top_nine'] !!};
	</script>
@endsection