@extends('admin.layouts.dashboard')

@section('template_title')
	Showing User {{ $user->name }}
@endsection

@section('template_fastload_css')
@endsection

@section('content')
	 <div class="content-wrapper">
	    <section class="content-header">

			<h1>Mostrando {{ $user->name }}</h1>

            {!! Breadcrumbs::render('show_user_admin_view', $user) !!}

	    </section>
	    <section class="content">

			<ul>

					<a href="{{ URL::to('users/create') }}" class="btn btn-primary btn-sm iframe">
						<span class="fa fa-plus-circle"></span> Crear un nuevo usuario
					</a>

			</ul>

			    	{{--
			    	@include('admin.modules.profile-image-box-split-bg')
					--}}
			    	@include('admin.modules.profile-image-box')
			    	{{--
					@include('admin.modules.profile-image-box-w-bg')
			    	@include('admin.modules.profile-about')
					--}}

			<div class="jumbotron text-center">
				<p>
					<strong>Email:</strong> {{ $user->email }}<br>
				</p>
			</div>


	    </section>
	</div>
@endsection

@section('template_scripts')

    @include('admin.structure.dashboard-scripts')

@endsection