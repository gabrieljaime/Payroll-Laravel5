{{-- Set Template Body Classes --}}
<?php
	$templateBodybodyClasses = 'login-page';
?>

@extends('admin.layouts.auth')

@section('template_title')
	Login
@endsection

@section('template_fastload_css')
	.login-page, .register-page {
	background-image: url({!!url('storage/logoinicio.png'); !!})  !important;
	}
@endsection

@section('content')
    <div class="login-box">
		<div class="login-logo">
			<a style="margin-left: -23%" href="/"> {!! HTML::image('storage/logolgin.png') !!}
				</a>

		</div>
		<div class="login-box-body">

			<h4 class="login-box-msg">
			  	{{ Lang::get('auth.login') }}
			</h4>

			@include('admin.forms.login-form')

			<div class="row">
				<div class="col-xs-12">
					{{--<p class="text-center margin-top-1 margin-bottom-2">- OR -</p>

					--}}{{-- Calls Social Media Login Buttons with Icon Only --}}{{--
					--}}{{--@include('partials.sm-logins-icons')--}}{{--

					--}}{{-- Calls Social Media Login Buttons with Text and Icon --}}{{--
					 @include('partials.sm-logins-full')--}}

				</div>
</div>

<hr class="login-full-span">


<div class="row btn-block">
<div class="col-xs-12">
    {!! HTML::icon_link( "/password/email", 'fa fa-'.Lang::get('auth.forgot_icon'), Lang::get('auth.forgot'), array('title' => Lang::get('auth.forgot'), 'id' => 'forgot')) !!}
</div>
</div>

</div>
</div>
@endsection

@section('template_scripts')

{!! HTML::script('/assets/js/login.js', array('type' => 'text/javascript')) !!}
@include('scripts.checkbox')
@include('scripts.show-hide-passwords')

@endsection