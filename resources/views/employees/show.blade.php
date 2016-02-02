@extends('admin.layouts.dashboard')

@section('template_title')
	Ver Empleados
@endsection

@section('template_fastload_css')


@endsection

@section('content')
	<div class="content-wrapper">
		<section class="content-header">

			<h1>
				View Employees
			</h1>

			{!! Breadcrumbs::render('create_employees') !!}

		</section>
		<section class="content">
	 		@include('employees.show_fields')
		</section>
		<br>
		<br>
		<br>
	</div>



@endsection
		@section('template_scripts')


			@include('admin.structure.dashboard-scripts')
			@include('scripts.address-lookup-g-api')
			@include('scripts.modals')

		@endsection
