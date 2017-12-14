@extends('layout.master')

@section('content')
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