@extends('login_design')
@section('css')
    <link href="{{ URL::asset('_CSS/login_css.css') }}" rel="stylesheet">
@endsection

@section('content')

<div class="content1">
	<h1 class="font1" style="margin-top: 18%;">DECORATE YOUR LIFE WITH FLOWERS</h1>
	<a href="/home" type="button" class="btn Shalala btn-sm">Learn More</a>
</div>

<div class="background-wrap">
	<video id="video-ng-elem" preload="auto" autoplay="true" loop="loop" muted="muted">
		<source src="{{ URL::asset('videos/Spring Flower.mp4') }}" type="video/mp4">
	</video>
</div>


@endsection